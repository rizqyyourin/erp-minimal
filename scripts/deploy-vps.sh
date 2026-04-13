#!/usr/bin/env bash

set -euo pipefail

APP_DIR="${APP_DIR:-/var/www/erp-minimal}"
APP_HOST="${APP_HOST:-erp.yourin.my.id}"
BRANCH="${BRANCH:-main}"
PHP_FPM_SERVICE="${PHP_FPM_SERVICE:-php8.2-fpm}"
LOG_FILE="${LOG_FILE:-/tmp/erp-minimal-deploy.log}"

exec > >(tee -a "$LOG_FILE") 2>&1

echo "[$(date -Iseconds)] Starting ERP deploy in '$APP_DIR'"

cd "$APP_DIR"

current_branch="$(git rev-parse --abbrev-ref HEAD)"
if [[ "$current_branch" != "$BRANCH" ]]; then
  echo "Refusing deploy: current branch is '$current_branch', expected '$BRANCH'."
  exit 1
fi

if [[ -n "$(git status --porcelain)" ]]; then
  echo "Refusing deploy: working tree is dirty."
  git status --short
  exit 1
fi

echo "[$(date -Iseconds)] Fetching latest branch '$BRANCH'"
git fetch origin "$BRANCH"
echo "[$(date -Iseconds)] Pulling latest branch '$BRANCH'"
git pull --ff-only origin "$BRANCH"

echo "[$(date -Iseconds)] Installing PHP dependencies"
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-progress

echo "[$(date -Iseconds)] Installing frontend dependencies"
npm ci

echo "[$(date -Iseconds)] Building frontend assets"
npm run build

echo "[$(date -Iseconds)] Running database migrations"
php artisan migrate --force

if [[ ! -L public/storage ]]; then
  echo "[$(date -Iseconds)] Creating storage symlink"
  php artisan storage:link
fi

echo "[$(date -Iseconds)] Refreshing Laravel caches"
php artisan optimize:clear
php artisan optimize
php artisan queue:restart || true

echo "[$(date -Iseconds)] Fixing writable directory ownership"
chown -R www-data:www-data storage bootstrap/cache

if systemctl list-unit-files | grep -q "^${PHP_FPM_SERVICE}"; then
  echo "[$(date -Iseconds)] Reloading ${PHP_FPM_SERVICE}"
  systemctl reload "$PHP_FPM_SERVICE"
fi

echo "[$(date -Iseconds)] Running local health check"
curl --fail --silent --show-error --resolve "${APP_HOST}:443:127.0.0.1" "https://${APP_HOST}/" >/dev/null
echo "Deploy complete for '${APP_HOST}'."