@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <x-page-heading title="Product Details" description="View product information and stock history">
        <x-slot name="actions">
            <a href="{{ route('products.edit', $product) }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Edit Product</a>
        </x-slot>
    </x-page-heading>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $product->name }}</h2>
                        <p class="text-sm text-slate-500">SKU: {{ $product->sku }}</p>
                    </div>
                    <span class="rounded-full px-4 py-2 text-sm font-semibold
                        @if($product->status === 'active') bg-emerald-50 text-emerald-700
                        @elseif($product->status === 'low_stock') bg-amber-50 text-amber-700
                        @else bg-rose-50 text-rose-700
                        @endif">
                        {{ ucfirst(str_replace('_', ' ', $product->status)) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Price</p>
                        <p class="text-lg font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Cost</p>
                        <p class="text-lg font-semibold">Rp {{ number_format($product->cost, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Stock</p>
                        <p class="text-lg font-semibold">{{ $product->stock }} pcs</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Min Stock</p>
                        <p class="text-lg font-semibold">{{ $product->min_stock }} pcs</p>
                    </div>
                </div>

                @if($product->category)
                <div class="mb-4">
                    <p class="text-xs uppercase tracking-wide text-slate-400">Category</p>
                    <p class="text-sm">{{ $product->category }}</p>
                </div>
                @endif

                @if($product->description)
                <div>
                    <p class="text-xs uppercase tracking-wide text-slate-400">Description</p>
                    <p class="text-sm text-slate-600">{{ $product->description }}</p>
                </div>
                @endif
            </div>

            @if($product->inventoryTransactions->count() > 0)
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <h3 class="text-lg font-semibold mb-4">Stock History</h3>
                <div class="space-y-3">
                    @foreach($product->inventoryTransactions as $transaction)
                    <div class="flex justify-between items-center p-3 bg-slate-50 rounded-2xl">
                        <div>
                            <p class="font-semibold">
                                @if($transaction->type === 'in')
                                    <span class="text-emerald-600">+{{ $transaction->qty }}</span>
                                @elseif($transaction->type === 'out')
                                    <span class="text-rose-600">-{{ abs($transaction->qty) }}</span>
                                @else
                                    <span class="text-slate-600">Adjust: {{ $transaction->qty }}</span>
                                @endif
                            </p>
                            <p class="text-xs text-slate-500">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                        </div>
                        @if($transaction->notes)
                        <p class="text-sm text-slate-600">{{ $transaction->notes }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('inventory.index') }}" class="block w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300 text-center">
                        View Inventory
                    </a>
                    <a href="{{ route('products.index') }}" class="block w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300 text-center">
                        Back to Products
                    </a>
                </div>
            </div>

            <div class="rounded-3xl border border-rose-100 bg-white p-6">
                <h3 class="text-lg font-semibold mb-4 text-rose-700">Delete Product</h3>
                <p class="text-sm text-slate-500 mb-4">This action cannot be undone</p>
                <form method="POST" action="{{ route('products.destroy', $product) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-2xl border border-rose-600 px-4 py-2 text-sm font-semibold text-rose-700 hover:bg-rose-50">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
