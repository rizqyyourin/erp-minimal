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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" integrity="sha512-w2pexnox96M1gL0Ija+K1Pc1HoF4DW/xFcKpKwlBW7P0mF7ZvDP7i0jPqsd5ZSvkijYEaqaQ3+r4o8IyYH0nNQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.7/cdn.min.js" integrity="sha512-lm7YTY+O+qLcbCR+4cdFJv3jXLW9L1nLS5z0+U/SkqbtfjhnbvnfFgUB7JRxGaWzyrOVQd4mjHgNsx3Rp3XIQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireStyles
    @stack('styles')
</head>
<body class="h-full font-[Inter] text-slate-900 antialiased">
    <div class="flex min-h-screen bg-slate-50">
        <aside class="hidden w-72 shrink-0 border-r border-slate-100 bg-white lg:block">
            <a href="{{ route('landing') }}" class="flex items-center gap-2 px-8 py-6 hover:bg-slate-50 transition-colors">
                <img src="https://img.freepik.com/vektor-premium/logo-erp-huruf-erp-desain-logo-huruf-erp-inisial-logo-erp-terhubung-dengan-lingkaran-dan-logo-monogram-huruf-besar-tipografi-erp-untuk-bisnis-teknologi-dan-merek-real-estat_229120-74568.jpg" alt="Logo" class="h-10 w-10 rounded-xl object-cover">
                <div>
                    <p class="text-sm font-semibold text-slate-900">ERP Minimal</p>
                    <p class="text-xs text-slate-500">Multi-tenant SaaS</p>
                </div>
            </a>
            <div class="px-6">
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
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                                </svg>
                            </span>
                            <input type="text" placeholder="Quick search" class="w-full rounded-2xl border border-slate-200 bg-white pl-11 pr-4 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-slate-400 focus:outline-none">
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        @auth
                        <div class="relative" x-data="{ open: false }">
                            <button x-on:click="open = !open" class="flex items-center gap-3 rounded-2xl border border-slate-200 px-3 py-2 hover:border-slate-300">
                                <div class="text-right">
                                    <p class="text-sm font-semibold">{{ auth()->user()?->name ?? 'User' }}</p>
                                    <p class="text-xs text-slate-500">{{ auth()->user()?->email ?? '' }}</p>
                                </div>
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-white text-sm font-semibold">
                                    {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 2)) }}
                                </div>
                            </button>
                            <div x-show="open" x-on:click.away="open = false" 
                                class="absolute right-0 mt-2 w-56 rounded-2xl border border-slate-100 bg-white shadow-lg"
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
                                    <form method="POST" action="{{ route('logout') }}">
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
                    <p>© {{ date('Y') }} Minimal ERP. All rights reserved.</p>
                    <p>Created by <a href="https://yourin.my.id">Yourin</a></p>
                </div>
            </footer>
        </div>
    </div>

    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js" integrity="sha512-Ogk8Y2cQhUJQF6UVx/F4WRzE7dHGnkvVGnzlQozY1UIQQCN7PCKt3ztBwF1j5R4d0RyYP1UFDoNFuIBqmoeVdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('scripts')
</body>
</html>
