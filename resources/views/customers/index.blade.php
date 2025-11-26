@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <x-page-heading title="Customers" description="Keep billing info lightweight and clean">
        <x-slot name="actions">
            <a href="{{ route('customers.create') }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New customer</a>
        </x-slot>
    </x-page-heading>

    <div class="grid gap-6 lg:grid-cols-3">
        @forelse($customers as $customer)
            @php
                $outstanding = $customer->invoices()->whereNotIn('status', ['paid','cancelled'])->sum('total');
            @endphp
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-base font-semibold text-slate-900">{{ $customer->name }}</p>
                        <p class="text-xs text-slate-500">{{ $customer->email }}</p>
                    </div>
                    <span class="rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-600">Customer</span>
                </div>
                <div class="mt-4 space-y-2 text-sm text-slate-600">
                    @if($customer->phone)
                        <p>{{ $customer->phone }}</p>
                    @endif
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Outstanding</p>
                    <p class="text-lg font-semibold text-slate-900">Rp {{ number_format($outstanding,0,',','.') }}</p>
                </div>
                <div class="mt-4 flex justify-end gap-3">
                    <a href="{{ route('customers.show',$customer) }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:border-slate-300">View</a>
                    <a href="{{ route('invoices.create', ['customer_id' => $customer->id]) }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">Invoice</a>
                </div>
            </div>
        @empty
            <div class="col-span-3 rounded-3xl border border-dashed border-slate-200 bg-white p-12 text-center">
                <p class="text-sm text-slate-500">No customers yet</p>
                <a href="{{ route('customers.create') }}" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">Add first customer</a>
            </div>
        @endforelse
    </div>
@endsection
