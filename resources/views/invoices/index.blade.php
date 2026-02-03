@extends('layouts.app')

@section('content')
<x-page-heading 
    title="Invoices" 
    subtitle="Sales invoices and payment tracking"
    category="Sales"
/>

<div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)]">
    <div class="flex justify-between items-center mb-6">
        <form method="GET" class="flex gap-3">
            <select name="status" class="h-10 rounded-2xl border border-slate-200 pl-4 pr-8 text-sm appearance-none bg-white">
                <option value="">All Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Partial</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Search invoices..." 
                class="rounded-2xl border border-slate-200 px-4 py-2 text-sm">
            <button type="submit" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                Filter
            </button>
        </form>
        @can('invoices.create')
        <a href="{{ route('invoices.create') }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
            + New Invoice
        </a>
        @endcan
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-100">
        <table class="min-w-full divide-y divide-slate-100 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Invoice #</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Due Date</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($invoices as $invoice)
                <tr>
                    <td class="px-6 py-4 font-semibold">{{ $invoice->invoice_number }}</td>
                    <td class="px-6 py-4">{{ $invoice->customer->name }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="rounded-full px-3 py-1 text-xs font-semibold 
                            @if($invoice->status === 'paid') bg-emerald-50 text-emerald-700
                            @elseif($invoice->status === 'cancelled') bg-rose-50 text-rose-700
                            @elseif($invoice->status === 'partial') bg-amber-50 text-amber-700
                            @else bg-slate-50 text-slate-700
                            @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $invoice->due_date?->format('d M Y') ?? '-' }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('invoices.show', $invoice) }}" 
                            class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        No invoices found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $invoices->links() }}
    </div>
</div>
@endsection
