@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
    <div class="mb-6">
        <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to customers
        </a>
    </div>

    <x-page-heading title="{{ $customer->name }}" description="Customer details and invoice history">
        <x-slot name="actions">
            <a href="{{ route('customers.edit', $customer) }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Edit</a>
            <a href="{{ route('invoices.create', ['customer_id' => $customer->id]) }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New invoice</a>
        </x-slot>
    </x-page-heading>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <p class="mb-4 text-xs uppercase tracking-[0.3em] text-slate-400">Contact Information</p>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email</p>
                        <p class="mt-1 text-sm text-slate-900">{{ $customer->email }}</p>
                    </div>
                    
                    @if($customer->phone)
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Phone</p>
                            <p class="mt-1 text-sm text-slate-900">{{ $customer->phone }}</p>
                        </div>
                    @endif
                    
                    @if($customer->address)
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Address</p>
                            <p class="mt-1 text-sm text-slate-900">{{ $customer->address }}</p>
                        </div>
                    @endif
                </div>

                <div class="mt-6 pt-6 border-t border-slate-100">
                    @php
                        $outstanding = $customer->invoices()->whereNotIn('status', ['paid','cancelled'])->sum('total');
                    @endphp
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Outstanding Balance</p>
                    <p class="mt-2 text-2xl font-semibold text-slate-900">Rp {{ number_format($outstanding,0,',','.') }}</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <p class="mb-4 text-xs uppercase tracking-[0.3em] text-slate-400">Invoice History</p>
                
                @forelse($customer->invoices()->latest()->get() as $invoice)
                    <div class="flex items-center justify-between border-b border-slate-100 py-4 last:border-0">
                        <div>
                            <p class="font-semibold text-slate-900">{{ $invoice->invoice_number }}</p>
                            <p class="text-xs text-slate-500">{{ $invoice->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="font-semibold text-slate-900">Rp {{ number_format($invoice->total,0,',','.') }}</p>
                                <span class="inline-block rounded-full px-2 py-0.5 text-xs font-semibold 
                                    {{ $invoice->status === 'paid' ? 'bg-emerald-50 text-emerald-700' : 
                                       ($invoice->status === 'cancelled' ? 'bg-slate-100 text-slate-600' : 'bg-amber-50 text-amber-700') }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </div>
                            <a href="{{ route('invoices.show', $invoice) }}" class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">View</a>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center">
                        <p class="text-sm text-slate-500">No invoices yet</p>
                        <a href="{{ route('invoices.create', ['customer_id' => $customer->id]) }}" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">Create first invoice</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
