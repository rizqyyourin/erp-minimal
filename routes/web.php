<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::view('/', 'landing')->name('landing');
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

// Protected routes
Route::middleware('auth')->prefix('app')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Products
    Route::middleware(['permission:products.view'])->get('products', [ProductController::class, 'index'])->name('products.index');
    Route::middleware(['permission:products.create'])->group(function () {
        Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->name('products.store');
    });
    Route::middleware(['permission:products.view'])->get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::middleware(['permission:products.edit'])->group(function () {
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    });
    Route::middleware(['permission:products.delete'])->delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Customers
    Route::middleware(['permission:customers.view'])->get('customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::middleware(['permission:customers.create'])->group(function () {
        Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
    });
    Route::middleware(['permission:customers.view'])->get('customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::middleware(['permission:customers.edit'])->group(function () {
        Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    });
    Route::middleware(['permission:customers.delete'])->delete('customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Suppliers
    Route::middleware(['permission:suppliers.view'])->get('suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::middleware(['permission:suppliers.create'])->group(function () {
        Route::get('suppliers/create', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    });
    Route::middleware(['permission:suppliers.view'])->get('suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::middleware(['permission:suppliers.edit'])->group(function () {
        Route::get('suppliers/{supplier}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    });
    Route::middleware(['permission:suppliers.delete'])->delete('suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    // Invoices
    Route::middleware(['permission:invoices.view'])->get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::middleware(['permission:invoices.create'])->group(function () {
        Route::get('invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
        Route::post('invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    });
    Route::middleware(['permission:invoices.view'])->get('invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::middleware(['permission:invoices.edit'])->group(function () {
        Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
        Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
    });
    Route::middleware(['permission:invoices.delete'])->delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::middleware(['permission:invoices.cancel'])->post('invoices/{invoice}/cancel', [InvoiceController::class, 'cancel'])->name('invoices.cancel');

    // Payments
    Route::middleware(['permission:payments.create'])->post('invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('payments.store');

    // Inventory
    Route::middleware(['permission:inventory.view'])->get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::middleware(['permission:inventory.adjust'])->group(function () {
        Route::get('inventory/adjust', function () {
            $products = \App\Models\Product::orderBy('name')->get();

            return view('inventory.adjust', compact('products'));
        })->name('inventory.adjust');
        Route::post('inventory/adjust', [InventoryController::class, 'adjust'])->name('inventory.adjust.store');
    });

    // Reports
    Route::middleware(['permission:reports.view'])->get('reports', [ReportController::class, 'index'])->name('reports.index');

    // Users & Roles (combined page with tabs) - Admin only
    Route::middleware(['permission:users.view'])->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });
    Route::middleware(['permission:users.create'])->group(function () {
        Route::post('users', [UserController::class, 'store'])->name('users.store');
    });
    Route::middleware(['permission:users.edit'])->group(function () {
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    });
    Route::middleware(['permission:users.delete'])->group(function () {
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Roles (within Users context) - Admin only
    Route::middleware(['permission:roles.manage'])->group(function () {
        Route::resource('roles', RoleController::class)->only(['store', 'update', 'destroy']);
        Route::get('roles/{role}/users', [UserController::class, 'getUsersByRole'])->name('roles.users');
    });

    // Profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('account/delete', [ProfileController::class, 'deleteForm'])->name('account.delete');
    Route::delete('account', [ProfileController::class, 'destroy'])->name('account.destroy');
});
