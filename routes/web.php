<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;

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
	Route::resource('products', ProductController::class);
	
	// Customers
	Route::resource('customers', CustomerController::class);
	
	// Suppliers
	Route::resource('suppliers', SupplierController::class);
	
	// Invoices
	Route::resource('invoices', InvoiceController::class);
	Route::post('invoices/{invoice}/cancel', [InvoiceController::class, 'cancel'])->name('invoices.cancel');
	
	// Payments
	Route::post('invoices/{invoice}/payments', [PaymentController::class, 'store'])->name('payments.store');
	
	// Inventory
	Route::get('inventory', [InventoryController::class, 'index'])->name('inventory.index');
	Route::get('inventory/adjust', function() {
		$products = \App\Models\Product::orderBy('name')->get();
		return view('inventory.adjust', compact('products'));
	})->name('inventory.adjust');
	Route::post('inventory/adjust', [InventoryController::class, 'adjust'])->name('inventory.adjust.store');
	
	// Profile
	Route::get('profile', [ProfileController::class, 'index'])->name('profile');
	Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::get('account/delete', [ProfileController::class, 'deleteForm'])->name('account.delete');
	Route::delete('account', [ProfileController::class, 'destroy'])->name('account.destroy');
});
