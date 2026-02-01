@extends('layouts.app')

@section('title', 'Edit Invoice')

@section('content')
    <x-page-heading title="Edit Invoice" description="Modify invoice details">
        <x-slot name="actions">
            <a href="{{ route('invoices.show', $invoice) }}" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</a>
        </x-slot>
    </x-page-heading>

    <div class="rounded-3xl border border-slate-100 bg-white p-6">
        <form method="POST" action="{{ route('invoices.update', $invoice) }}">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="customer_id" class="block text-sm font-semibold text-slate-700 mb-2">Customer</label>
                        <select name="customer_id" id="customer_id" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-2">Due Date</label>
                        <input type="date" name="due_date" id="due_date" required value="{{ $invoice->due_date->format('Y-m-d') }}"
                            class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                        @error('due_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Title (Optional)</label>
                    <input type="text" name="title" id="title" value="{{ $invoice->title }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                        placeholder="Invoice title">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="reference" class="block text-sm font-semibold text-slate-700 mb-2">Reference (Optional)</label>
                    <input type="text" name="reference" id="reference" value="{{ $invoice->reference }}"
                        class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none"
                        placeholder="Reference number">
                    @error('reference')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="border-t border-slate-100 pt-6">
                    <h3 class="text-lg font-semibold mb-4">Invoice Items</h3>
                    <p class="text-sm text-slate-500 mb-4">Note: Items cannot be edited. To change items, please cancel this invoice and create a new one.</p>
                    
                    <table class="w-full text-sm">
                        <thead class="border-b">
                            <tr>
                                <th class="pb-3 text-left text-xs uppercase">Product</th>
                                <th class="pb-3 text-right text-xs uppercase">Qty</th>
                                <th class="pb-3 text-right text-xs uppercase">Price</th>
                                <th class="pb-3 text-right text-xs uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->items as $item)
                            <tr class="border-b">
                                <td class="py-3">{{ $item->product->name }}</td>
                                <td class="py-3 text-right">{{ $item->qty }}</td>
                                <td class="py-3 text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-3 text-right font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="pt-4 text-right">Subtotal:</td>
                                <td class="pt-4 text-right">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Discount:</td>
                                <td class="text-right">Rp {{ number_format($invoice->discount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right">Tax:</td>
                                <td class="text-right">Rp {{ number_format($invoice->tax, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-t-2">
                                <td colspan="3" class="pt-3 text-right text-lg font-bold">Total:</td>
                                <td class="pt-3 text-right text-lg font-bold">Rp {{ number_format($invoice->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('invoices.show', $invoice) }}" class="rounded-2xl border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</a>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white hover:bg-slate-800">Update Invoice</button>
                </div>
            </div>
        </form>
    </div>
@endsection
