@extends('layouts.app')

@section('title', $supplier->name)

@section('content')
    <x-page-heading title="Supplier Details" description="View supplier information">
        <x-slot name="actions">
            <a href="{{ route('suppliers.edit', $supplier) }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Edit Supplier</a>
        </x-slot>
    </x-page-heading>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold">{{ $supplier->name }}</h2>
                        <p class="text-sm text-slate-500">Supplier</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Email</p>
                        <p class="text-lg font-semibold">{{ $supplier->email }}</p>
                    </div>

                    @if($supplier->phone)
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Phone</p>
                        <p class="text-lg font-semibold">{{ $supplier->phone }}</p>
                    </div>
                    @endif

                    @if($supplier->address)
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Address</p>
                        <p class="text-sm text-slate-600">{{ $supplier->address }}</p>
                    </div>
                    @endif

                    @if($supplier->lead_time_days)
                    <div>
                        <p class="text-xs uppercase tracking-wide text-slate-400">Lead Time</p>
                        <p class="text-lg font-semibold">{{ $supplier->lead_time_days }} days</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('suppliers.index') }}" class="block w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300 text-center">
                        Back to Suppliers
                    </a>
                </div>
            </div>

            <div class="rounded-3xl border border-rose-100 bg-white p-6">
                <h3 class="text-lg font-semibold mb-4 text-rose-700">Delete Supplier</h3>
                <p class="text-sm text-slate-500 mb-4">This action cannot be undone</p>
                <form method="POST" action="{{ route('suppliers.destroy', $supplier) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full rounded-2xl border border-rose-600 px-4 py-2 text-sm font-semibold text-rose-700 hover:bg-rose-50">
                        Delete Supplier
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
