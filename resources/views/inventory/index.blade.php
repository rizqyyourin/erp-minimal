@extends('layouts.app')

@section('title', 'Inventory')

@section('content')
    <x-page-heading title="Inventory Movements" description="Single timeline for stock in/out/adjust">
        <x-slot name="actions">
            <div class="flex items-center gap-2">
                <form method="GET" action="{{ route('inventory.index') }}" class="flex gap-2">
                    <select name="type" class="rounded-xl border border-slate-200 bg-white pl-4 pr-8 py-2 h-10 text-sm text-slate-700 leading-tight">
                        <option value="">All types</option>
                        <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Stock In</option>
                        <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Stock Out</option>
                        <option value="adjust" {{ request('type') == 'adjust' ? 'selected' : '' }}>Adjust</option>
                    </select>
                    <select name="product_id" class="rounded-xl border border-slate-200 bg-white pl-4 pr-8 py-2 h-10 text-sm text-slate-700 leading-tight">
                        <option value="">All products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded-xl border border-slate-200 bg-white px-4 py-2 h-10 text-sm font-semibold text-slate-700 hover:border-slate-300">Filter</button>
                </form>
                @can('inventory.adjust')
                <a href="{{ route('inventory.adjust') }}" class="rounded-2xl bg-slate-900 px-4 py-2 h-10 text-sm font-semibold text-white hover:bg-slate-800 flex items-center">+ Manual adjust</a>
                @endcan
            </div>
        </x-slot>
    </x-page-heading>

    <div class="rounded-3xl border border-slate-100 bg-white p-6">
        <div class="space-y-6">
            @forelse($transactions as $trx)
                <div class="flex flex-col gap-4 rounded-2xl border border-slate-100 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl {{ $trx->type === 'in' ? 'bg-emerald-50 text-emerald-700' : ($trx->type === 'out' ? 'bg-amber-50 text-amber-700' : 'bg-indigo-50 text-indigo-700') }} font-semibold uppercase">{{ $trx->type }}</span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">{{ $trx->product->name ?? 'Unknown product' }}</p>
                            @if($trx->product)
                                <p class="text-xs text-slate-500">SKU {{ $trx->product->sku }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-lg font-semibold text-slate-900">{{ $trx->qty }} pcs</p>
                            @if($trx->notes)
                                <p class="text-xs text-slate-500">{{ $trx->notes }}</p>
                            @endif
                        </div>
                        <p class="text-xs text-slate-400">{{ $trx->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-200 p-10 text-center">
                    <p class="text-sm text-slate-500">No inventory movements yet</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
