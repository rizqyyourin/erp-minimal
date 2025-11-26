@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="mb-6">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to products
        </a>
    </div>

    <x-page-heading title="Edit Product" description="Update product information" />

    <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)]">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Product Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sku" class="mb-2 block text-sm font-semibold text-slate-700">SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('sku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="mb-2 block text-sm font-semibold text-slate-700">Category</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="cost" class="mb-2 block text-sm font-semibold text-slate-700">Cost (Rp)</label>
                    <input type="number" name="cost" id="cost" value="{{ old('cost', $product->cost) }}" step="0.01"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('cost')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="mb-2 block text-sm font-semibold text-slate-700">Selling Price (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" step="0.01"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="mb-2 block text-sm font-semibold text-slate-700">Current Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-slate-500">To adjust stock history, use the inventory page</p>
                </div>

                <div class="sm:col-span-2">
                    <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                        Save Changes
                    </button>
                    <a href="{{ route('products.index') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Cancel
                    </a>
                </div>
                <button type="button" onclick="showDeleteModal()" class="rounded-xl border border-red-300 px-6 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50">
                    Delete Product
                </button>
            </div>
        </form>

        <form id="delete-form" method="POST" action="{{ route('products.destroy', $product) }}" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="hideDeleteModal()"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="relative w-full max-w-md rounded-3xl bg-white p-8 shadow-2xl">
                <div class="flex flex-col items-center text-center">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-semibold text-slate-900">Delete Product</h3>
                    <p class="mt-2 text-sm text-slate-600">Are you sure you want to delete <span class="font-semibold">{{ $product->name }}</span>? This action cannot be undone.</p>
                    <div class="mt-6 flex w-full gap-3">
                        <button type="button" onclick="hideDeleteModal()" class="flex-1 rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Cancel
                        </button>
                        <button type="button" onclick="document.getElementById('delete-form').submit()" class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                            Yes, Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal() {
            document.getElementById('delete-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function hideDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') hideDeleteModal();
        });
    </script>
@endsection
