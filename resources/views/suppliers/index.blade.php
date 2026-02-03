@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
    <x-page-heading title="Suppliers" description="Quick visibility on inbound stock partners">
        <x-slot name="actions">
            @can('suppliers.create')
            <a href="{{ route('suppliers.create') }}" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New supplier</a>
            @endcan
        </x-slot>
    </x-page-heading>

    <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white">
        <table class="min-w-full text-sm">
            <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-6 py-3 text-left">Supplier</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Phone</th>
                    <th class="px-6 py-3 text-left">Address</th>
                    <th class="px-6 py-3 text-left">Lead time</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($suppliers as $supplier)
                    <tr>
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-900">{{ $supplier->name }}</p>
                            @if($supplier->lead_time_days)
                                <p class="text-xs text-slate-500">Lead {{ $supplier->lead_time_days }} days</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $supplier->email }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $supplier->phone ?? '-' }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $supplier->address ?? '-' }}</td>
                        <td class="px-6 py-4 text-slate-900">{{ $supplier->lead_time_days ? $supplier->lead_time_days.' days' : '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            @can('suppliers.edit')
                            <a href="{{ route('suppliers.edit', $supplier) }}" class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">Edit</a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <p class="text-sm text-slate-500">No suppliers yet</p>
                            @can('suppliers.create')
                            <a href="{{ route('suppliers.create') }}" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">Add supplier</a>
                            @endcan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
