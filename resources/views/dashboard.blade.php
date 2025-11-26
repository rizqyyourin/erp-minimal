@extends('layouts.app')

@section('title', 'Overview')

@section('content')
    <x-page-heading title="Today" description="Snapshot of sales, cashflow, and stock health">
        <x-slot name="actions">
            <a href="{{ route('invoices.create') }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New invoice</a>
        </x-slot>
    </x-page-heading>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <x-stat-card label="MRR" value="Rp {{ number_format($stats['mrr'], 0, ',', '.') }}" meta="this month" />
        <x-stat-card label="Outstanding invoices" value="{{ $stats['outstanding_invoices_count'] }}" meta="Rp {{ number_format($stats['outstanding_invoices_amount'], 0, ',', '.') }} due" />
        <x-stat-card label="Low stock" value="{{ $stats['low_stock_count'] }} items" meta="Need attention" />
        <x-stat-card label="Payments today" value="Rp {{ number_format($stats['payments_today_amount'], 0, ',', '.') }}" meta="{{ $stats['payments_today_count'] }} payments" />
    </div>

    <div class="mt-10 grid gap-6 lg:grid-cols-2">
        <section class="rounded-3xl border border-slate-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Pipeline</p>
                    <h2 class="text-lg font-semibold text-slate-900">Recent Invoices</h2>
                </div>
                <a href="{{ route('invoices.create') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900">View all</a>
            </div>
            <div class="mt-6 space-y-4">
                @forelse($recentInvoices as $invoice)
                    <a href="{{ route('invoices.show', $invoice) }}" class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-3 hover:border-slate-200 transition">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">{{ $invoice->invoice_number }}</p>
                            <p class="text-xs text-slate-500">{{ $invoice->customer->name }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium 
                                {{ $invoice->status === 'paid' ? 'bg-emerald-50 text-emerald-700' : 
                                   ($invoice->status === 'pending' ? 'bg-amber-50 text-amber-700' : 
                                   ($invoice->status === 'partial' ? 'bg-blue-50 text-blue-700' : 'bg-slate-50 text-slate-700')) }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp {{ number_format($invoice->total, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-500">{{ $invoice->due_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-sm text-slate-500">No invoices yet</p>
                        <a href="{{ route('invoices.create') }}" class="mt-2 inline-block text-sm font-semibold text-slate-900">Create your first invoice</a>
                    </div>
                @endforelse
            </div>
        </section>
        <section class="rounded-3xl border border-slate-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Stock watch</p>
                    <h2 class="text-lg font-semibold text-slate-900">Critical items</h2>
                </div>
                <a href="{{ route('inventory.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-900">View details</a>
            </div>
            <div class="mt-6 divide-y divide-slate-100">
                @forelse($criticalStock as $product)
                    <div class="flex items-center justify-between py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">{{ $product->name }}</p>
                            <p class="text-xs text-slate-500">SKU {{ $product->sku }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-semibold text-slate-900">{{ $product->stock }} pcs</span>
                            <span class="rounded-full px-3 py-1 text-xs font-medium 
                                {{ $product->stock > $product->min_stock ? 'bg-emerald-50 text-emerald-700' : 
                                   ($product->stock > 0 ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                                {{ $product->stock > $product->min_stock ? 'Healthy' : ($product->stock > 0 ? 'Low' : 'Critical') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center">
                        <p class="text-sm text-slate-500">All stock levels are healthy</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
