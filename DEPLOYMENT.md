# ERP Deployment

This repository deploys to the production VPS through GitHub Actions.

## Flow

1. Push to `main`.
2. GitHub Actions validates Composer install and the Vite build.
3. GitHub Actions connects to the VPS over SSH.
4. The VPS runs `scripts/deploy-vps.sh`.
5. The script pulls the latest `main`, installs PHP and frontend dependencies, builds assets, runs migrations, refreshes Laravel caches, and reloads PHP-FPM.

## Required GitHub Secrets

- `VPS_HOST`: production server hostname or IP.
- `VPS_PORT`: SSH port.
- `VPS_USER`: SSH user used for deploy.
- `VPS_SSH_PRIVATE_KEY`: private key for the deploy user.

## Server Assumptions

- Repository path: `/var/www/erp-minimal`
- Branch: `main`
- PHP-FPM service: `php8.2-fpm`
- PHP 8.2, Composer, Node.js, and npm are installed on the server.
- The application `.env` is already configured on the VPS.

## Safety Checks

- Deploy fails if the VPS checkout is on the wrong branch.
- Deploy fails if the VPS working tree is dirty.
- Deploy uses `git pull --ff-only` to avoid silent merges on the server.
- Deploy runs a local HTTPS health check against `erp.yourin.my.id`.

## Notes

- Do not edit production files directly on the VPS.
- `public/storage` will be created automatically if missing.
- Queue restart is included so future queue workers pick up fresh code.