<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
  <img src="https://img.shields.io/badge/Livewire-3-FB70A9?style=for-the-badge&logo=livewire&logoColor=white" alt="Livewire">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
</p>

<h1 align="center">✨ Minimal ERP</h1>

<p align="center">
  <strong>Modern, minimal ERP system for small businesses</strong><br>
  Sales, inventory, and master data management — without the clutter.
</p>

<p align="center">
  <a href="#-features">Features</a> •
  <a href="#-screenshots">Screenshots</a> •
  <a href="#-installation">Installation</a> •
  <a href="#-usage">Usage</a> •
  <a href="#-tech-stack">Tech Stack</a>
</p>

---

## 🎯 Features

### 📊 Dashboard
- **Real-time metrics** — MRR, outstanding invoices, low stock alerts, daily payments
- **Quick actions** — Create invoice directly from dashboard
- **Pipeline view** — Recent invoices with status badges

### 📦 Products Management
- Full CRUD with search & pagination
- SKU, sell price, cost price, stock tracking
- Category organization
- Stock status indicators (active, low stock, critical)

### 👥 Customers & Suppliers
- Customer database with contact info
- Supplier management with addresses
- Linked to invoices for easy tracking

### 🧾 Invoices & Payments
- Dynamic invoice builder with Livewire
- Auto-calculate subtotal, tax (11%), and total
- Partial payment support
- Payment methods: Cash, Transfer, Card, Giro
- Cancel invoice with automatic stock revert

### 📈 Inventory Tracking
- Stock in/out logging
- Manual stock adjustments
- Full transaction history with references

### 👤 User Profile
- Update profile information
- Secure account deletion with confirmation

---

## 📸 Screenshots

| Dashboard | Invoice Builder |
|:---------:|:---------------:|
| ![Dashboard](https://via.placeholder.com/400x250/f1f5f9/64748b?text=Dashboard) | ![Invoice](https://via.placeholder.com/400x250/f1f5f9/64748b?text=Invoice+Builder) |

| Products | Inventory |
|:--------:|:---------:|
| ![Products](https://via.placeholder.com/400x250/f1f5f9/64748b?text=Products) | ![Inventory](https://via.placeholder.com/400x250/f1f5f9/64748b?text=Inventory) |

---

## 🚀 Installation

### Requirements
- PHP 8.2+
- Composer
- Node.js 18+
- SQLite / MySQL / PostgreSQL

### Quick Start

```bash
# Clone the repository
git clone https://github.com/yourusername/minimal-erp.git
cd minimal-erp

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
npm run build

# Start development server
php artisan serve
```

### One-Command Setup

```bash
composer setup
```

This will install all dependencies, generate app key, run migrations, and build assets.

### Development Mode

```bash
composer dev
```

Runs Laravel server, queue worker, and Vite in parallel.

---

## 💡 Usage

### Default Flow

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│  Products   │────▶│   Invoice   │────▶│   Payment   │
│  (Stock)    │     │  (Pending)  │     │   (Paid)    │
└─────────────┘     └─────────────┘     └─────────────┘
       │                   │                   │
       ▼                   ▼                   ▼
   Stock -qty         Creates log        Updates status
```

### Invoice Lifecycle

| Status | Description |
|--------|-------------|
| `pending` | Invoice created, awaiting payment |
| `partial` | Partially paid |
| `paid` | Fully paid |
| `cancelled` | Cancelled, stock reverted |

### Stock Adjustment Types

| Type | Effect |
|------|--------|
| `stock_in` | Increase stock (purchase, return) |
| `stock_out` | Decrease stock (sales) |
| `adjustment` | Manual correction |

---

## 🛠 Tech Stack

| Layer | Technology |
|-------|------------|
| **Framework** | Laravel 12 |
| **Frontend** | Blade Templates |
| **Styling** | Tailwind CSS 4.0 |
| **Interactivity** | Alpine.js, Livewire 3 |
| **Database** | SQLite (default), MySQL, PostgreSQL |
| **Testing** | Pest PHP |
| **Build Tool** | Vite |

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Route controllers
│   ├── Livewire/             # Livewire components
│   ├── Models/               # Eloquent models
│   └── Services/             # Business logic
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── resources/views/
│   ├── components/           # Blade components
│   ├── layouts/              # App layouts
│   ├── products/             # Product views
│   ├── invoices/             # Invoice views
│   └── ...                   # Other modules
└── routes/
    └── web.php               # Web routes
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙏 Credits

Built with ❤️ by [Yourin](https://yourin.my.id)

**Tech Stack:**
- [Laravel](https://laravel.com) — PHP Framework
- [Tailwind CSS](https://tailwindcss.com) — Utility-first CSS
- [Livewire](https://livewire.laravel.com) — Full-stack framework
- [Alpine.js](https://alpinejs.dev) — Lightweight JS framework
- [Flowbite](https://flowbite.com) — UI Components

---

<p align="center">
  <sub>⭐ Star this repo if you find it useful!</sub>
</p>
