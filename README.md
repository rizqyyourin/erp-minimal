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
  <a href="#-architecture">Architecture</a> •
  <a href="#-features">Features</a> •
  <a href="#-database-schema">Database</a> •
  <a href="#-installation">Installation</a> •
  <a href="#-project-structure">Structure</a>
</p>

---

## 🏗️ Architecture

### **System Overview**

```
┌─────────────────────────────────────────────────────────────────┐
│                         CLIENT LAYER                             │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │  Blade Templates + Alpine.js + Tailwind CSS             │   │
│  │  - Login/Register Forms                                  │   │
│  │  - Dashboard with Real-time Metrics                      │   │
│  │  - CRUD Interfaces (Products, Customers, Suppliers)      │   │
│  │  - Invoice Builder (Livewire)                            │   │
│  │  - Payment Management                                    │   │
│  └──────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────┘
                              ↕ HTTP/HTTPS
┌─────────────────────────────────────────────────────────────────┐
│                      APPLICATION LAYER                           │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │  Laravel 12 Framework                                    │   │
│  │                                                          │   │
│  │  ┌────────────────────────────────────────────────────┐  │   │
│  │  │ Controllers (Route Handlers)                      │  │   │
│  │  │ - ProductController, CustomerController          │  │   │
│  │  │ - SupplierController, InvoiceController          │  │   │
│  │  │ - PaymentController, InventoryController         │  │   │
│  │  │ - ProfileController, AuthController             │  │   │
│  │  └────────────────────────────────────────────────────┘  │   │
│  │                          ↕                               │   │
│  │  ┌────────────────────────────────────────────────────┐  │   │
│  │  │ Services (Business Logic)                         │  │   │
│  │  │ - InvoiceService (create, cancel, payments)      │  │   │
│  │  │ - InventoryService (stock management)            │  │   │
│  │  └────────────────────────────────────────────────────┘  │   │
│  │                          ↕                               │   │
│  │  ┌────────────────────────────────────────────────────┐  │   │
│  │  │ Models (Eloquent ORM)                             │  │   │
│  │  │ - Product, Customer, Supplier, Invoice            │  │   │
│  │  │ - Payment, InventoryTransaction, User             │  │   │
│  │  └────────────────────────────────────────────────────┘  │   │
│  └──────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────┘
                              ↕ SQL
┌─────────────────────────────────────────────────────────────────┐
│                       DATA LAYER                                 │
│  ┌──────────────────────────────────────────────────────────┐   │
│  │  SQLite / MySQL / PostgreSQL                            │   │
│  │  - Products, Customers, Suppliers                       │   │
│  │  - Invoices, Invoice Items, Payments                    │   │
│  │  - Inventory Transactions, Users                        │   │
│  └──────────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🗄️ Database Schema

### **Entity Relationship Diagram**

```
┌──────────────┐         ┌───────────────┐
│   USERS      │         │   CUSTOMERS   │
├──────────────┤         ├───────────────┤
│ id (PK)      │         │ id (PK)       │
│ name         │         │ name          │
│ email        │         │ email         │
│ password     │         │ phone         │
│ created_at   │         │ address       │
│ updated_at   │         │ created_at    │
└──────────────┘         └───────────────┘
                                ↑
                                │ (hasMany)
                                │
                         ┌──────────────────┐
                         │    INVOICES      │
                         ├──────────────────┤
                         │ id (PK)          │
                         │ customer_id (FK) │
                         │ invoice_number   │
                         │ title            │
                         │ subtotal         │
                         │ discount         │
                         │ tax              │
                         │ total            │
                         │ status           │
                         │ due_date         │
                         │ created_at       │
                         └──────────────────┘
                          ↑              ↓
                    (hasMany)      (hasMany)
                          │              │
        ┌─────────────────┘              └─────────────────┐
        │                                                  │
   ┌────────────────┐                           ┌──────────────────┐
   │ INVOICE_ITEMS  │                           │    PAYMENTS      │
   ├────────────────┤                           ├──────────────────┤
   │ id (PK)        │                           │ id (PK)          │
   │ invoice_id(FK) │                           │ invoice_id (FK)  │
   │ product_id(FK) │                           │ amount           │
   │ qty            │                           │ method           │
   │ price          │                           │ paid_at          │
   │ subtotal       │                           │ notes            │
   └────────────────┘                           │ created_at       │
        ↓                                        └──────────────────┘
   ┌──────────────┐
   │  PRODUCTS    │
   ├──────────────┤
   │ id (PK)      │
   │ name         │
   │ sku          │
   │ price        │
   │ cost         │
   │ stock        │
   │ category     │
   │ description  │
   │ created_at   │
   └──────────────┘
        ↓
        │ (hasMany)
        │
   ┌──────────────────────────┐
   │ INVENTORY_TRANSACTIONS   │
   ├──────────────────────────┤
   │ id (PK)                  │
   │ product_id (FK)          │
   │ qty                      │
   │ type (in/out/adjust)     │
   │ reference_type           │
   │ reference_id             │
   │ notes                    │
   │ created_at               │
   └──────────────────────────┘

┌─────────────────┐
│    SUPPLIERS    │
├─────────────────┤
│ id (PK)         │
│ name            │
│ email           │
│ phone           │
│ address         │
│ lead_time_days  │
│ created_at      │
└─────────────────┘
```

### **Table Details**

| Table | Purpose | Key Fields |
|-------|---------|-----------|
| `users` | Authentication & user accounts | id, name, email, password |
| `products` | Inventory master data | id, name, sku, price, cost, stock |
| `customers` | Customer information | id, name, email, phone, address |
| `suppliers` | Supplier information | id, name, email, phone, address |
| `invoices` | Sales invoices | id, customer_id, invoice_number, status, total |
| `invoice_items` | Invoice line items | id, invoice_id, product_id, qty, price |
| `payments` | Payment records | id, invoice_id, amount, method, paid_at |
| `inventory_transactions` | Stock movement log | id, product_id, qty, type, reference_type |

---

## 💻 Backend Architecture

### **Controllers** (Route Handlers)

```
app/Http/Controllers/
├── AuthController
│   ├── showRegister()     → resources/views/auth/register.blade.php
│   ├── register()         → Create user account
│   ├── showLogin()        → resources/views/auth/login.blade.php
│   ├── login()            → Authenticate user
│   └── logout()           → Destroy session
│
├── DashboardController
│   └── index()            → Dashboard with stats & metrics
│
├── ProductController (RESTful)
│   ├── index()            → List products with pagination
│   ├── create()           → Show create form
│   ├── store()            → Save new product
│   ├── show()             → View product details
│   ├── edit()             → Show edit form
│   ├── update()           → Update product
│   └── destroy()          → Delete product (soft delete)
│
├── CustomerController (RESTful)
│   ├── index()            → List customers
│   ├── create()           → Show create form
│   ├── store()            → Save new customer
│   ├── show()             → View customer details
│   ├── edit()             → Show edit form
│   ├── update()           → Update customer
│   └── destroy()          → Delete customer
│
├── SupplierController (RESTful)
│   ├── index()            → List suppliers
│   ├── create()           → Show create form
│   ├── store()            → Save new supplier
│   ├── show()             → View supplier details
│   ├── edit()             → Show edit form
│   ├── update()           → Update supplier
│   └── destroy()          → Delete supplier
│
├── InvoiceController (RESTful + Custom)
│   ├── index()            → List invoices
│   ├── create()           → Show invoice builder
│   ├── store()            → Create invoice + adjust stock
│   ├── show()             → View invoice details
│   ├── cancel()           → Cancel invoice + revert stock
│
├── PaymentController
│   └── store()            → Record payment → Update invoice status
│
├── InventoryController
│   ├── index()            → List inventory transactions
│   └── adjust()           → Manual stock adjustment
│
└── ProfileController
    ├── index()            → Show profile form
    ├── update()           → Update profile
    ├── deleteForm()       → Show delete confirmation
    └── destroy()          → Delete user account
```

### **Services** (Business Logic)

```
app/Services/
├── InvoiceService
│   ├── createInvoice()     → Create invoice + deduct stock
│   ├── cancelInvoice()     → Cancel invoice + restore stock
│   └── recordPayment()     → Record payment + update status
│
└── InventoryService
    └── adjustStock()       → Adjust stock + log transaction
```

### **Models** (Eloquent ORM)

```
app/Models/
├── User               → belongsToMany(Invoice) [via payments]
├── Product            → hasMany(InvoiceItem)
│                     → hasMany(InventoryTransaction)
│
├── Customer           → hasMany(Invoice)
│
├── Supplier           → (standalone)
│
├── Invoice            → belongsTo(Customer)
│                     → hasMany(InvoiceItem)
│                     → hasMany(Payment)
│
├── InvoiceItem        → belongsTo(Invoice)
│                     → belongsTo(Product)
│
├── Payment            → belongsTo(Invoice)
│
└── InventoryTransaction → belongsTo(Product)
```

---

## 🎨 Frontend Architecture

### **Template Structure**

```
resources/views/
├── layouts/
│   └── app.blade.php          (Main layout with sidebar, header)
│
├── auth/
│   ├── login.blade.php        (Login form)
│   └── register.blade.php     (Register form)
│
├── dashboard.blade.php        (Dashboard with metrics)
│
├── products/
│   ├── index.blade.php        (Products list with search/filter)
│   ├── create.blade.php       (Create product form)
│   ├── edit.blade.php         (Edit product form)
│   └── show.blade.php         (Product details)
│
├── customers/
│   ├── index.blade.php        (Customers list)
│   ├── create.blade.php       (Create customer form)
│   ├── edit.blade.php         (Edit customer form)
│   └── show.blade.php         (Customer details)
│
├── suppliers/
│   ├── index.blade.php        (Suppliers list)
│   ├── create.blade.php       (Create supplier form)
│   ├── edit.blade.php         (Edit supplier form)
│
├── invoices/
│   ├── index.blade.php        (Invoices list with status badges)
│   ├── create.blade.php       (Invoice builder - Livewire)
│   └── show.blade.php         (Invoice details + payment form)
│
├── inventory/
│   ├── index.blade.php        (Inventory transactions log)
│   └── adjust.blade.php       (Manual stock adjustment form)
│
├── profile/
│   ├── index.blade.php        (Profile edit form)
│   └── delete.blade.php       (Delete account with confirmation)
│
└── components/
    ├── page-heading.blade.php (Page title + actions)
    ├── sidebar-link.blade.php (Sidebar menu link)
    └── stat-card.blade.php    (Dashboard metric card)
```

### **Frontend Technologies**

| Layer | Technology | Purpose |
|-------|-----------|---------|
| **Templating** | Blade | PHP template engine |
| **Styling** | Tailwind CSS 4.0 | Utility-first CSS framework |
| **Interactivity** | Alpine.js | Lightweight JavaScript |
| **Forms** | Livewire 3 | Dynamic server-side components |
| **Build Tool** | Vite | Fast bundler for assets |

### **Key Frontend Features**

- **Responsive Design** — Mobile-first with Tailwind CSS
- **Delete Confirmations** — Modal dialogs using Alpine.js
- **Dynamic Invoices** — Livewire component for real-time calculations
- **Search & Filter** — JavaScript-free server-side filtering
- **Form Validation** — Client & server-side validation
- **Status Badges** — Color-coded status indicators
- **Pagination** — Efficient data browsing

---

## 🔄 Data Flow Examples

### **Example 1: Create Product**

```
User fills form → POST /app/products
  ↓
ProductController::store()
  ↓
Validate: name, sku, price, cost, stock
  ↓
Product::create($validated)
  ↓
Database: INSERT into products
  ↓
Redirect to /app/products with success message
```

### **Example 2: Create Invoice & Adjust Stock**

```
User selects products → POST /app/invoices
  ↓
InvoiceController::store()
  ↓
InvoiceService::createInvoice()
  ↓
1. Calculate: subtotal, tax (11%), total
2. INSERT into invoices
3. INSERT into invoice_items
4. For each item:
   - product.stock -= qty
   - INSERT into inventory_transactions (stock_out)
  ↓
Return invoice details page
```

### **Example 3: Record Payment**

```
User enters payment amount → POST /app/invoices/{id}/payments
  ↓
PaymentController::store()
  ↓
InvoiceService::recordPayment()
  ↓
1. INSERT into payments
2. Calculate totalPaid = sum(payments)
3. If totalPaid >= total:
   - Update invoice.status = 'paid'
   Else:
   - Update invoice.status = 'partial'
  ↓
Redirect with success message
```

### **Example 4: Cancel Invoice & Revert Stock**

```
User clicks Cancel → POST /app/invoices/{id}/cancel
  ↓
InvoiceController::cancel()
  ↓
InvoiceService::cancelInvoice()
  ↓
For each invoice_item:
  - product.stock += qty
  - INSERT into inventory_transactions (stock_in)
- Update invoice.status = 'cancelled'
  ↓
Redirect to invoice details
```

---

## 🚀 Installation

### Requirements
- PHP 8.2+
- Composer
- Node.js 18+
- SQLite / MySQL / PostgreSQL

### Quick Start

```bash
# Clone repository
git clone https://github.com/rizqyyourin/erp-minimal.git
cd erp-minimal

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database (development)
php artisan migrate:fresh

# Build assets
npm run build

# Start development server
php artisan serve
```

### Production Deployment

```bash
# 1. Clone & install
git clone https://github.com/rizqyyourin/erp-minimal.git
cd erp-minimal
composer install --no-dev --optimize-autoloader
npm install
npm run build

# 2. Configure environment
cp .env.example .env
# Edit .env with:
# - APP_ENV=production
# - APP_URL=https://yourdomain.com
# - DB_CONNECTION, DB_DATABASE, etc.

# 3. Setup database
php artisan key:generate
php artisan migrate --force

# 4. Optimize
php artisan optimize

# 5. Configure web server (Nginx/Apache)
# Point document root to: /var/www/erp-minimal/public
```

---

## 📁 Project Structure

```
erp-minimal/
├── app/
│   ├── Http/
│   │   └── Controllers/         (10 controllers)
│   ├── Models/                  (8 models)
│   ├── Services/                (2 services)
│   └── Providers/               (AppServiceProvider)
│
├── routes/
│   └── web.php                  (Web routes)
│
├── database/
│   ├── migrations/              (10 migrations)
│   ├── factories/               (7 factories)
│   └── seeders/                 (DatabaseSeeder)
│
├── resources/
│   ├── views/                   (40+ Blade templates)
│   │   ├── layouts/
│   │   ├── auth/
│   │   ├── products/
│   │   ├── customers/
│   │   ├── suppliers/
│   │   ├── invoices/
│   │   ├── inventory/
│   │   ├── profile/
│   │   └── components/
│   ├── css/                     (Tailwind CSS)
│   └── js/                      (Alpine.js scripts)
│
├── public/
│   ├── index.php                (Entry point)
│   └── build/                   (Compiled assets)
│
├── tests/
│   ├── Feature/                 (5 feature tests)
│   └── Unit/                    (Unit tests)
│
├── config/
│   ├── app.php
│   ├── database.php
│   ├── cache.php
│   └── ...                      (Laravel configs)
│
├── composer.json                (PHP dependencies)
├── package.json                 (Node dependencies)
├── vite.config.js               (Vite config)
└── README.md                    (This file)
```

---

## 🛠️ Tech Stack

| Category | Technology | Version |
|----------|-----------|---------|
| **Framework** | Laravel | 12.x |
| **Language** | PHP | 8.2+ |
| **Database** | SQLite/MySQL/PostgreSQL | Any |
| **Frontend** | Blade + Tailwind CSS | 4.0 |
| **Interactivity** | Alpine.js | Latest |
| **Full-stack** | Livewire | 3.x |
| **Build Tool** | Vite | 7.x |
| **Testing** | Pest PHP | 4.x |
| **Package Manager** | Composer + NPM | Latest |

---

## 📝 License

MIT License - Open source and free for commercial use.

---

## 🙏 Credits

Built with ❤️ by [Yourin](https://yourin.my.id)

---

<p align="center">
  <sub>⭐ Star this repo if you find it useful!</sub>
</p>
