@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <x-page-heading title="Product Catalog" description="Master data shared across tenants, kept deliberately clean">
        <x-slot name="actions">
            @can('products.create')
            <a href="{{ route('products.create') }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New product</a>
            @endcan
        </x-slot>
    </x-page-heading>

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-3">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product or SKU" class="rounded-2xl border border-slate-200 bg-slate-50 pl-9 pr-3 py-2 text-sm focus:border-slate-300 focus:bg-white focus:outline-none">
                </div>
            </form>
            <a href="{{ route('inventory.index') }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">View inventory</a>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">SKU</th>
                        <th class="px-6 py-3 text-left">Cost</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3 text-left">Stock</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($products ?? [] as $product)
                        <tr>
                            <td class="px-6 py-4 text-slate-900">
                                <p class="font-semibold">{{ $product->name }}</p>
                                <p class="text-xs text-slate-500">SKU {{ $product->sku }}</p>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $product->sku }}</td>
                            <td class="px-6 py-4 text-slate-900">Rp {{ number_format($product->cost,0,',','.') }}</td>
                            <td class="px-6 py-4 text-slate-900">Rp {{ number_format($product->price,0,',','.') }}</td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-900">{{ $product->stock }} pcs</span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $status = $product->stock > $product->min_stock ? 'Active' : ($product->stock > 0 ? 'Low stock' : 'Critical');
                                @endphp
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $status === 'Active' ? 'bg-emerald-50 text-emerald-700' : ($status === 'Low stock' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">{{ $status }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @can('products.edit')
                                <a href="{{ route('products.edit', $product) }}" class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">Edit</a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <p class="text-sm text-slate-500">No products yet</p>
                                @can('products.create')
                                <a href="{{ route('products.create') }}" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Add your first product</a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
