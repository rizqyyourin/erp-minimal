<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SaaS ERP')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        [x-cloak] { display: none !important; }

        #app-loading-bar {
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        #app-loading-bar.is-visible {
            opacity: 1;
        }

        #app-loading-bar-progress {
            width: 0%;
            transition: width 0.25s ease-out;
        }
        
        /* HTML5 Dialog centering - relative to viewport */
        dialog {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            margin: 0;
            max-height: 90vh;
        }
        
        dialog::backdrop {
            background: rgba(15, 23, 42, 0.5);
        }
    </style>
    @livewireStyles
    @stack('styles')
</head>
<body class="h-full font-[Inter] text-slate-900 antialiased">
    <div id="app-loading-bar" class="pointer-events-none fixed inset-x-0 top-0 z-[100] h-1 bg-transparent">
        <div id="app-loading-bar-progress" class="h-full bg-slate-900 shadow-[0_0_12px_rgba(15,23,42,0.35)]"></div>
    </div>

    @php
        $can = fn (?string $permission = null) => $permission === null ? true : (bool) auth()->user()?->hasPermission($permission);

        $quickActions = [
            [
                'title' => 'Overview',
                'description' => 'Main dashboard and business snapshot',
                'url' => route('dashboard'),
                'intent' => 'browse',
                'available' => true,
                'aliases' => ['dashboard', 'overview', 'home', 'beranda', 'ringkasan', 'main page'],
            ],
            [
                'title' => 'Profile Settings',
                'description' => 'Manage profile and account settings',
                'url' => route('profile'),
                'intent' => 'manage',
                'available' => true,
                'aliases' => ['profile', 'profil', 'account', 'akun', 'settings', 'pengaturan', 'edit profile', 'account settings'],
            ],
            [
                'title' => 'Delete Account',
                'description' => 'Open the account deletion page',
                'url' => route('account.delete'),
                'intent' => 'manage',
                'available' => true,
                'aliases' => ['delete account', 'remove account', 'hapus akun', 'close account'],
            ],

            [
                'title' => 'Products',
                'description' => 'Browse the product catalog',
                'url' => route('products.index'),
                'intent' => 'browse',
                'available' => $can('products.view'),
                'aliases' => ['product', 'products', 'produk', 'catalog', 'katalog', 'product list', 'daftar produk', 'browse products'],
            ],
            [
                'title' => 'New Product',
                'description' => 'Create a new product',
                'url' => route('products.create'),
                'intent' => 'create',
                'available' => $can('products.create'),
                'aliases' => ['create product', 'new product', 'add product', 'create new product', 'produk baru', 'buat produk', 'tambah produk'],
            ],
            [
                'title' => 'Low Stock Products',
                'description' => 'Open products filtered by low stock',
                'url' => route('products.index', ['status' => 'low_stock']),
                'intent' => 'browse',
                'available' => $can('products.view'),
                'aliases' => ['low stock', 'stok menipis', 'produk hampir habis', 'low stock products', 'product low stock'],
            ],
            [
                'title' => 'Critical Stock Products',
                'description' => 'Open products filtered by critical stock',
                'url' => route('products.index', ['status' => 'critical']),
                'intent' => 'browse',
                'available' => $can('products.view'),
                'aliases' => ['critical stock', 'stok kritis', 'produk kritis', 'out of stock risk'],
            ],

            [
                'title' => 'Customers',
                'description' => 'Browse customer records',
                'url' => route('customers.index'),
                'intent' => 'browse',
                'available' => $can('customers.view'),
                'aliases' => ['customer', 'customers', 'pelanggan', 'client', 'klien', 'customer list', 'daftar customer'],
            ],
            [
                'title' => 'New Customer',
                'description' => 'Create a new customer',
                'url' => route('customers.create'),
                'intent' => 'create',
                'available' => $can('customers.create'),
                'aliases' => ['create customer', 'new customer', 'add customer', 'pelanggan baru', 'buat customer', 'tambah customer'],
            ],

            [
                'title' => 'Suppliers',
                'description' => 'Browse supplier records',
                'url' => route('suppliers.index'),
                'intent' => 'browse',
                'available' => $can('suppliers.view'),
                'aliases' => ['supplier', 'suppliers', 'vendor', 'pemasok', 'supplier list', 'daftar supplier'],
            ],
            [
                'title' => 'New Supplier',
                'description' => 'Create a new supplier',
                'url' => route('suppliers.create'),
                'intent' => 'create',
                'available' => $can('suppliers.create'),
                'aliases' => ['create supplier', 'new supplier', 'add supplier', 'supplier baru', 'buat supplier', 'tambah supplier'],
            ],

            [
                'title' => 'Invoices',
                'description' => 'Browse invoices and payment status',
                'url' => route('invoices.index'),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['invoice', 'invoices', 'bill', 'tagihan', 'invoice list', 'daftar invoice'],
            ],
            [
                'title' => 'New Invoice',
                'description' => 'Create a new invoice',
                'url' => route('invoices.create'),
                'intent' => 'create',
                'available' => $can('invoices.create'),
                'aliases' => ['create invoice', 'new invoice', 'add invoice', 'invoice baru', 'buat invoice', 'tambah invoice'],
            ],
            [
                'title' => 'Draft Invoices',
                'description' => 'Open invoices filtered by draft status',
                'url' => route('invoices.index', ['status' => 'draft']),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['draft invoices', 'invoice draft', 'draft tagihan'],
            ],
            [
                'title' => 'Pending Invoices',
                'description' => 'Open invoices filtered by pending status',
                'url' => route('invoices.index', ['status' => 'pending']),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['pending invoices', 'invoice pending', 'tagihan pending', 'belum lunas'],
            ],
            [
                'title' => 'Partial Invoices',
                'description' => 'Open invoices filtered by partial status',
                'url' => route('invoices.index', ['status' => 'partial']),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['partial invoices', 'invoice partial', 'partially paid'],
            ],
            [
                'title' => 'Paid Invoices',
                'description' => 'Open invoices filtered by paid status',
                'url' => route('invoices.index', ['status' => 'paid']),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['paid invoices', 'invoice paid', 'lunas', 'tagihan lunas'],
            ],
            [
                'title' => 'Overdue Invoices',
                'description' => 'Open invoices filtered by overdue status',
                'url' => route('invoices.index', ['status' => 'overdue']),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['overdue invoices', 'jatuh tempo', 'invoice overdue', 'telat bayar'],
            ],
            [
                'title' => 'Cancelled Invoices',
                'description' => 'Open invoices filtered by cancelled status',
                'url' => route('invoices.index', ['status' => 'cancelled']),
                'intent' => 'browse',
                'available' => $can('invoices.view'),
                'aliases' => ['cancelled invoices', 'invoice cancelled', 'invoice dibatalkan', 'tagihan batal'],
            ],

            [
                'title' => 'Inventory',
                'description' => 'View stock movement history',
                'url' => route('inventory.index'),
                'intent' => 'browse',
                'available' => $can('inventory.view'),
                'aliases' => ['inventory', 'stock', 'stok', 'warehouse', 'gudang', 'inventory history', 'stock movement', 'riwayat stok'],
            ],
            [
                'title' => 'Adjust Inventory',
                'description' => 'Open manual stock adjustment form',
                'url' => route('inventory.adjust'),
                'intent' => 'manage',
                'available' => $can('inventory.adjust'),
                'aliases' => ['adjust inventory', 'adjust stock', 'stock adjustment', 'manual stock adjustment', 'sesuaikan stok', 'ubah stok'],
            ],

            [
                'title' => 'Reports',
                'description' => 'Open the financial reports page',
                'url' => route('reports.index'),
                'intent' => 'browse',
                'available' => $can('reports.view'),
                'aliases' => ['reports', 'report', 'laporan', 'analytics', 'analitik', 'financial report', 'laporan keuangan'],
            ],
            [
                'title' => 'Weekly Reports',
                'description' => 'Open reports filtered to this week',
                'url' => route('reports.index', ['period' => 'week']),
                'intent' => 'browse',
                'available' => $can('reports.view'),
                'aliases' => ['weekly report', 'laporan mingguan', 'report minggu ini'],
            ],
            [
                'title' => 'Monthly Reports',
                'description' => 'Open reports filtered to this month',
                'url' => route('reports.index', ['period' => 'month']),
                'intent' => 'browse',
                'available' => $can('reports.view'),
                'aliases' => ['monthly report', 'laporan bulanan', 'report bulan ini'],
            ],
            [
                'title' => 'Quarterly Reports',
                'description' => 'Open reports filtered to this quarter',
                'url' => route('reports.index', ['period' => 'quarter']),
                'intent' => 'browse',
                'available' => $can('reports.view'),
                'aliases' => ['quarterly report', 'laporan kuartal', 'report quarter'],
            ],
            [
                'title' => 'Yearly Reports',
                'description' => 'Open reports filtered to this year',
                'url' => route('reports.index', ['period' => 'year']),
                'intent' => 'browse',
                'available' => $can('reports.view'),
                'aliases' => ['yearly report', 'annual report', 'laporan tahunan', 'report tahun ini'],
            ],

            [
                'title' => 'Users',
                'description' => 'Manage application users',
                'url' => route('users.index', ['tab' => 'users']),
                'intent' => 'manage',
                'available' => $can('users.view'),
                'aliases' => ['users', 'user', 'pengguna', 'team', 'anggota', 'user management', 'manage users', 'daftar user'],
            ],
            [
                'title' => 'Roles',
                'description' => 'Manage roles and permissions',
                'url' => route('users.index', ['tab' => 'roles']),
                'intent' => 'manage',
                'available' => $can('users.view'),
                'aliases' => ['roles', 'role', 'permissions', 'permission', 'hak akses', 'akses', 'role management', 'manage roles'],
            ],
        ];
    @endphp
    <div class="flex min-h-screen bg-slate-50">
        <aside class="sticky top-0 hidden h-screen w-72 shrink-0 overflow-y-auto border-r border-slate-100 bg-white lg:block">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 px-8 py-6 hover:bg-slate-50 transition-colors">
                <img src="https://img.freepik.com/vektor-premium/logo-erp-huruf-erp-desain-logo-huruf-erp-inisial-logo-erp-terhubung-dengan-lingkaran-dan-logo-monogram-huruf-besar-tipografi-erp-untuk-bisnis-teknologi-dan-merek-real-estat_229120-74568.jpg" alt="Logo" class="h-10 w-10 rounded-xl object-cover">
                <div>
                    <p class="text-sm font-semibold text-slate-900">ERP Minimal</p>
                    <p class="text-xs text-slate-500">Multi-tenant SaaS</p>
                </div>
            </a>
            <div class="px-6 pb-8">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-slate-400">Core</p>
                <nav class="flex flex-col gap-1">
                    <x-sidebar-link href="{{ route('dashboard') }}" label="Overview" :active="request()->routeIs('dashboard')" permission="dashboard.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4.5 10.5V21h5.25v-6.75h4.5V21H19.5V10.5" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('products.index') }}" label="Products" :active="request()->routeIs('products.*')" permission="products.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('customers.index') }}" label="Customers" :active="request()->routeIs('customers.*')" permission="customers.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 21v-1a7 7 0 0114 0v1" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('invoices.index') }}" label="Invoices" :active="request()->routeIs('invoices.*')" permission="invoices.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 11h5M9 21h6a3 3 0 003-3V6a3 3 0 00-3-3H9a3 3 0 00-3 3v12a3 3 0 003 3z" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('inventory.index') }}" label="Inventory" :active="request()->routeIs('inventory.*')" permission="inventory.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('reports.index') }}" label="Reports" :active="request()->routeIs('reports.*')" permission="reports.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('users.index') }}" label="Users" :active="request()->routeIs('users.*')" permission="users.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                    <x-sidebar-link href="{{ route('suppliers.index') }}" label="Suppliers" :active="request()->routeIs('suppliers.*')" permission="suppliers.view">
                        <x-slot name="icon">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v7" />
                            </svg>
                        </x-slot>
                    </x-sidebar-link>
                </nav>
            </div>
        </aside>
        <div class="flex min-h-screen flex-1 flex-col">
            <header class="sticky top-0 z-10 border-b border-slate-100 bg-white">
                <div class="flex flex-col gap-3 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="w-full sm:w-1/2">
                        <div
                            class="relative"
                            x-data="featureQuickSearch(@js($quickActions))"
                            @click.away="close()"
                            @keydown.escape.window="close()"
                        >
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                                </svg>
                            </span>
                            <input
                                x-ref="input"
                                x-model="query"
                                type="text"
                                placeholder="Search features"
                                class="w-full rounded-2xl border border-slate-200 bg-white pl-11 pr-4 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-slate-400 focus:outline-none"
                                @focus="open()"
                                @input="updateResults()"
                                @keydown.arrow-down.prevent="move(1)"
                                @keydown.arrow-up.prevent="move(-1)"
                                @keydown.enter.prevent="goToSelection()"
                            >

                            <div
                                x-cloak
                                x-show="isOpen"
                                x-transition.origin.top.left
                                class="absolute left-0 right-0 mt-2 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60"
                            >
                                <template x-if="results.length > 0">
                                    <div class="py-2">
                                        <template x-for="(result, index) in results" :key="result.url">
                                            <button
                                                type="button"
                                                class="flex w-full items-center justify-between gap-4 px-4 py-3 text-left transition-colors"
                                                :class="[
                                                    activeIndex === index ? 'bg-slate-50' : 'bg-white hover:bg-slate-50',
                                                    result.available ? '' : 'opacity-80'
                                                ]"
                                                @mouseenter="activeIndex = index"
                                                @click="go(result)"
                                            >
                                                <div>
                                                    <p class="text-sm font-semibold text-slate-900" x-text="result.title"></p>
                                                    <p class="text-xs text-slate-500" x-text="result.description"></p>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        x-show="!result.available"
                                                        class="rounded-full bg-rose-50 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-rose-600"
                                                    >Restricted</span>
                                                    <span class="rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-slate-500" x-text="result.intent"></span>
                                                </div>
                                            </button>
                                        </template>
                                    </div>
                                </template>

                                <div x-show="results.length === 0 && query.trim().length > 0" class="px-4 py-4 text-sm text-slate-500">
                                    Feature tidak ditemukan. Coba kata seperti "product", "invoice overdue", "stock adjust", "monthly report", atau "roles".
                                </div>

                                <div x-show="query.trim().length === 0" class="border-t border-slate-100 bg-slate-50 px-4 py-3 text-xs text-slate-500">
                                    Try: create product, paid invoices, stock adjust, monthly report, roles
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-3 rounded-2xl border border-slate-200 px-3 py-2 hover:border-slate-300">
                                <div class="text-right">
                                    <p class="text-sm font-semibold">{{ auth()->user()?->name ?? 'User' }}</p>
                                    <p class="text-xs text-slate-500">{{ auth()->user()?->email ?? '' }}</p>
                                </div>
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-white text-sm font-semibold">
                                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                                </div>
                            </button>
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 rounded-2xl border border-slate-100 bg-white shadow-lg z-50"
                                 style="display: none;">
                                <div class="p-2 space-y-1">
                                    <a href="{{ route('profile') }}" class="flex items-center gap-3 rounded-xl px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Profile settings</span>
                                    </a>
                                    <div class="my-1 border-t border-slate-100"></div>
                                    <a href="{{ route('account.delete') }}" class="flex w-full items-center gap-3 rounded-xl px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Delete account</span>
                                    </a>
                                    <div class="my-1 border-t border-slate-100"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="block">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Sign out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            </header>
            <main class="flex-1">
                <div class="mx-auto w-full max-w-7xl px-6 py-8">
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                            class="mb-6 flex items-center gap-3 rounded-2xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                            <button x-on:click="show = false" class="ml-auto">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show"
                            class="mb-6 flex items-center gap-3 rounded-2xl bg-red-50 px-4 py-3 text-sm text-red-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('error') }}</span>
                            <button x-on:click="show = false" class="ml-auto">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div x-data="{ show: true }" x-show="show"
                            class="mb-6 rounded-2xl bg-red-50 px-4 py-3 text-sm text-red-700">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Please fix the following errors:</span>
                                <button x-on:click="show = false" class="ml-auto">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <ul class="mt-2 list-inside list-disc pl-8">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>
            <footer class="border-t border-slate-100 bg-white">
                <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 text-xs text-slate-500">
                    <p>© {{ date('Y') }} ERP Minimal. All rights reserved.</p>
                    <p>Created by <a href="https://yourin.my.id">Yourin</a></p>
                </div>
            </footer>
        </div>
    </div>

    <script>
        function featureQuickSearch(actions) {
            return {
                actions,
                query: '',
                results: [],
                activeIndex: 0,
                isOpen: false,
                open() {
                    this.isOpen = true;
                    this.updateResults();
                },
                close() {
                    this.isOpen = false;
                    this.activeIndex = 0;
                },
                normalize(value) {
                    return (value || '')
                        .toLowerCase()
                        .replace(/[^a-z0-9\s]/g, ' ')
                        .replace(/\s+/g, ' ')
                        .trim();
                },
                tokenize(value) {
                    const normalizedValue = this.normalize(value)
                        .replace(/products/g, 'product')
                        .replace(/customers/g, 'customer')
                        .replace(/suppliers/g, 'supplier')
                        .replace(/invoices/g, 'invoice')
                        .replace(/reports/g, 'report')
                        .replace(/roles/g, 'role')
                        .replace(/users/g, 'user');

                    if (!normalizedValue) {
                        return [];
                    }

                    return Array.from(new Set(normalizedValue.split(' ').filter(Boolean).flatMap((token) => {
                        const variants = [token];

                        if (token.endsWith('s') && token.length > 3) {
                            variants.push(token.slice(0, -1));
                        }

                        return variants;
                    })));
                },
                buildSearchText(action) {
                    return this.normalize([
                        action.title,
                        action.description,
                        ...(action.aliases || []),
                        action.intent,
                    ].join(' '));
                },
                detectIntent(tokens) {
                    const hasCreateVerb = tokens.some((token) => ['create', 'new', 'add', 'buat', 'bikin', 'tambah'].includes(token));
                    const hasManageVerb = tokens.some((token) => ['manage', 'adjust', 'edit', 'update', 'change', 'hapus', 'delete', 'remove', 'ubah', 'sesuaikan'].includes(token));
                    const hasBrowseVerb = tokens.some((token) => ['open', 'browse', 'list', 'view', 'lihat', 'daftar', 'go'].includes(token));

                    if (hasCreateVerb && !hasManageVerb && !hasBrowseVerb) {
                        return 'create';
                    }

                    if (hasManageVerb && !hasCreateVerb && !hasBrowseVerb) {
                        return 'manage';
                    }

                    if (hasBrowseVerb && !hasCreateVerb && !hasManageVerb) {
                        return 'browse';
                    }

                    return null;
                },
                scoreAction(action, normalizedQuery) {
                    if (!normalizedQuery) {
                        return (action.available ? 100 : 80) + (action.intent === 'browse' ? 10 : 0);
                    }

                    const queryTokens = this.tokenize(normalizedQuery);
                    const searchText = this.buildSearchText(action);
                    const searchableTokens = this.tokenize(searchText);
                    let score = 0;

                    if (searchText.includes(normalizedQuery)) {
                        score += 160;
                    }

                    queryTokens.forEach((token) => {
                        if (searchableTokens.includes(token)) {
                            score += 35;
                        } else if (searchText.includes(token)) {
                            score += 15;
                        }
                    });

                    const hasCreateVerb = queryTokens.some((token) => ['create', 'new', 'add', 'buat', 'bikin', 'tambah'].includes(token));
                    const hasManageVerb = queryTokens.some((token) => ['manage', 'adjust', 'edit', 'update', 'change', 'hapus', 'delete', 'remove', 'ubah', 'sesuaikan'].includes(token));
                    const hasBrowseVerb = queryTokens.some((token) => ['open', 'browse', 'list', 'view', 'lihat', 'daftar', 'go'].includes(token));

                    if (hasCreateVerb && action.intent === 'create') {
                        score += 80;
                    }

                    if (hasManageVerb && action.intent === 'manage') {
                        score += 55;
                    }

                    if (hasBrowseVerb && action.intent === 'browse') {
                        score += 30;
                    }

                    if (queryTokens.length > 0 && queryTokens.every((token) => searchableTokens.includes(token) || searchText.includes(token))) {
                        score += 90;
                    }

                    if (action.available) {
                        score += 12;
                    }

                    return score;
                },
                updateResults() {
                    const normalizedQuery = this.normalize(this.query);
                    const queryTokens = this.tokenize(normalizedQuery);
                    const strictIntent = this.detectIntent(queryTokens);

                    this.results = this.actions
                        .map((action) => ({ ...action, score: this.scoreAction(action, normalizedQuery) }))
                        .filter((action) => !strictIntent || action.intent === strictIntent)
                        .filter((action) => action.score > 0)
                        .sort((left, right) => right.score - left.score || left.title.localeCompare(right.title))
                        .slice(0, 8);

                    this.activeIndex = 0;
                    this.isOpen = true;
                },
                move(step) {
                    if (!this.isOpen) {
                        this.open();
                        return;
                    }

                    if (!this.results.length) {
                        return;
                    }

                    const lastIndex = this.results.length - 1;
                    this.activeIndex = this.activeIndex + step;

                    if (this.activeIndex > lastIndex) {
                        this.activeIndex = 0;
                    }

                    if (this.activeIndex < 0) {
                        this.activeIndex = lastIndex;
                    }
                },
                goToSelection() {
                    if (!this.results.length) {
                        return;
                    }

                    this.go(this.results[this.activeIndex] || this.results[0]);
                },
                go(action) {
                    if (!action || !action.available) {
                        return;
                    }

                    window.location.href = action.url;
                },
            };
        }
    </script>

    @livewireScripts
    @stack('scripts')
</body>
</html>
