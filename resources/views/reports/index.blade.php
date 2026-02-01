@extends('layouts.app')

@section('title', 'Reports')

@section('content')
    <x-page-heading title="Financial Reports" description="Overview of your business performance">
        <div class="flex gap-3">
            <form method="GET" class="flex gap-2">
                <select name="period" onchange="this.form.submit()" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 focus:border-slate-400 focus:outline-none">
                    <option value="week" {{ $period === 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ $period === 'month' ? 'selected' : '' }}>This Month</option>
                    <option value="quarter" {{ $period === 'quarter' ? 'selected' : '' }}>This Quarter</option>
                    <option value="year" {{ $period === 'year' ? 'selected' : '' }}>This Year</option>
                </select>
            </form>
            <button class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition-colors">
                Export PDF
            </button>
        </div>
    </x-page-heading>

    <div class="mt-8 space-y-6">
        <!-- Stats Cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Revenue</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">Rp {{ number_format($revenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50">
                        <i class="ph-fill ph-trend-up text-2xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Expenses</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">Rp {{ number_format($expenses, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50">
                        <i class="ph-fill ph-trend-down text-2xl text-red-600"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Net Profit</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">Rp {{ number_format($profit, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50">
                        <i class="ph-fill ph-currency-circle-dollar text-2xl text-emerald-600"></i>
                    </div>
                </div>
                <p class="mt-2 text-sm {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $profit >= 0 ? '+' : '' }}{{ $revenue > 0 ? round(($profit / $revenue) * 100, 1) : 0 }}% margin
                </p>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Active Customers</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">{{ $customerStats['active'] }}</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50">
                        <i class="ph-fill ph-users text-2xl text-blue-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart & Invoice Status -->
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Revenue Overview</h3>
                <div class="h-64">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Invoice Status</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                            <span class="text-sm text-slate-600">Paid</span>
                        </div>
                        <span class="font-semibold text-slate-900">{{ $invoiceStats['paid'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-3 w-3 rounded-full bg-amber-500"></div>
                            <span class="text-sm text-slate-600">Pending</span>
                        </div>
                        <span class="font-semibold text-slate-900">{{ $invoiceStats['pending'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-3 w-3 rounded-full bg-red-500"></div>
                            <span class="text-sm text-slate-600">Overdue</span>
                        </div>
                        <span class="font-semibold text-slate-900">{{ $invoiceStats['overdue'] }}</span>
                    </div>
                    <div class="pt-4 border-t border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-500">Total Invoices</span>
                            <span class="font-semibold text-slate-900">{{ $invoiceStats['total'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Top Products</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="pb-3 text-left text-xs font-semibold uppercase text-slate-500">Product</th>
                            <th class="pb-3 text-right text-xs font-semibold uppercase text-slate-500">Qty Sold</th>
                            <th class="pb-3 text-right text-xs font-semibold uppercase text-slate-500">Total Sales</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($topProducts as $item)
                            <tr>
                                <td class="py-3">
                                    <p class="font-medium text-slate-900">{{ $item->product->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $item->product->sku }}</p>
                                </td>
                                <td class="py-3 text-right text-slate-700">{{ number_format($item->total_qty, 0, ',', '.') }}</td>
                                <td class="py-3 text-right font-semibold text-slate-900">Rp {{ number_format($item->total_sales, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-slate-500">No sales data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Customer Stats -->
        <div class="grid gap-6 sm:grid-cols-3">
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm font-medium text-slate-500">Total Customers</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ $customerStats['total'] }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm font-medium text-slate-500">New This Period</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ $customerStats['new'] }}</p>
            </div>
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <p class="text-sm font-medium text-slate-500">Active Customers</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ $customerStats['active'] }}</p>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('revenueChart');
                if (!ctx) return;

                const labels = @json($monthlyData['labels']);
                const revenueData = @json($monthlyData['revenue']);

                new Chart(ctx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Revenue',
                            data: revenueData,
                            borderColor: '#1e293b',
                            backgroundColor: 'rgba(30, 41, 59, 0.1)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1e293b',
                                titleFont: { size: 14, family: 'Inter' },
                                bodyFont: { size: 13, family: 'Inter' },
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: { size: 11, family: 'Inter' },
                                    color: '#64748b'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: '#e2e8f0'
                                },
                                ticks: {
                                    font: { size: 11, family: 'Inter' },
                                    color: '#64748b',
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
