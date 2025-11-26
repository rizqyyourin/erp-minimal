@extends('layouts.app')

@section('title', 'Create Customer')

@section('content')
    <div class="mb-6">
        <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to customers
        </a>
    </div>

    <x-page-heading title="New Customer" description="Add a new customer to your records" />

    <div class="rounded-3xl border border-slate-100 bg-white p-8 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)]">
        <form method="POST" action="{{ route('customers.store') }}">
            @csrf

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Customer Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="mb-2 block text-sm font-semibold text-slate-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="mb-2 block text-sm font-semibold text-slate-700">Address</label>
                    <textarea name="address" id="address" rows="3"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                    Create Customer
                </button>
                <a href="{{ route('customers.index') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
