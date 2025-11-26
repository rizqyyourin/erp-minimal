@extends('layouts.app')

@section('title', 'Manual Stock Adjustment')

@section('content')
    <div class="mb-6">
        <a href="{{ route('inventory.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to inventory
        </a>
    </div>

    <x-page-heading title="Manual Stock Adjustment" description="Adjust product stock directly" />

    <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)] max-w-xl mx-auto">
        <form method="POST" action="{{ route('inventory.adjust') }}">
            @csrf
            <div class="mb-6">
                <label for="product_id" class="mb-2 block text-sm font-semibold text-slate-700">Product</label>
                <select name="product_id" id="product_id" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900">
                    <option value="">Select product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="qty" class="mb-2 block text-sm font-semibold text-slate-700">Quantity</label>
                <input type="number" name="qty" id="qty" required min="1" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900">
                @error('qty')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="type" class="mb-2 block text-sm font-semibold text-slate-700">Type</label>
                <select name="type" id="type" required class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900">
                    <option value="in">Stock In</option>
                    <option value="out">Stock Out</option>
                    <option value="adjust">Adjust</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">Notes</label>
                <textarea name="notes" id="notes" rows="2" class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900"></textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">Save Adjustment</button>
                <a href="{{ route('inventory.index') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
