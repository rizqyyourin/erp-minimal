<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');
        
        $dateRange = $this->getDateRange($period);
        
        $revenue = $this->getRevenue($dateRange);
        $expenses = $this->getExpenses($dateRange);
        $profit = $revenue - $expenses;
        
        $monthlyData = $this->getMonthlyData((int) $dateRange['start']->year);
        $topProducts = $this->getTopProducts($dateRange);
        $customerStats = $this->getCustomerStats($dateRange);
        
        $invoiceStats = $this->getInvoiceStats($dateRange);
        
        return view('reports.index', compact(
            'period',
            'revenue',
            'expenses',
            'profit',
            'monthlyData',
            'topProducts',
            'customerStats',
            'invoiceStats'
        ));
    }

    private function getDateRange($period)
    {
        $now = Carbon::now();
        
        return match ($period) {
            'week' => [
                'start' => $now->copy()->startOfWeek(),
                'end' => $now->copy()->endOfWeek(),
            ],
            'month' => [
                'start' => $now->copy()->startOfMonth(),
                'end' => $now->copy()->endOfMonth(),
            ],
            'quarter' => [
                'start' => $now->copy()->startOfQuarter(),
                'end' => $now->copy()->endOfQuarter(),
            ],
            'year' => [
                'start' => $now->copy()->startOfYear(),
                'end' => $now->copy()->endOfYear(),
            ],
            default => [
                'start' => $now->copy()->startOfMonth(),
                'end' => $now->copy()->endOfMonth(),
            ],
        };
    }

    private function getRevenue($dateRange)
    {
        return Payment::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
            ->sum('amount');
    }

    private function getExpenses($dateRange)
    {
        return InvoiceItem::query()
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->whereBetween('invoices.created_at', [$dateRange['start'], $dateRange['end']])
            ->whereIn('invoices.status', ['paid', 'partial'])
            ->sum(DB::raw('invoice_items.qty * products.cost'));
    }

    private function getMonthlyData(int $year)
    {
        $revenueByMonth = Payment::query()
            ->selectRaw('EXTRACT(MONTH FROM paid_at) as month_number, SUM(amount) as total_revenue')
            ->whereYear('paid_at', $year)
            ->groupByRaw('EXTRACT(MONTH FROM paid_at)')
            ->pluck('total_revenue', 'month_number');

        $expensesByMonth = InvoiceItem::query()
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id')
            ->join('products', 'invoice_items.product_id', '=', 'products.id')
            ->selectRaw('EXTRACT(MONTH FROM invoices.created_at) as month_number, SUM(invoice_items.qty * products.cost) as total_expenses')
            ->whereYear('invoices.created_at', $year)
            ->whereIn('invoices.status', ['paid', 'partial'])
            ->groupByRaw('EXTRACT(MONTH FROM invoices.created_at)')
            ->pluck('total_expenses', 'month_number');

        $data = [
            'labels' => [],
            'revenue' => [],
            'expenses' => [],
            'profit' => [],
        ];

        for ($monthNumber = 1; $monthNumber <= 12; $monthNumber++) {
            $month = Carbon::create($year, $monthNumber, 1)->startOfMonth();
            $revenue = (float) ($revenueByMonth[$monthNumber] ?? 0);
            $cogs = (float) ($expensesByMonth[$monthNumber] ?? 0);
            
            $data['labels'][] = $month->format('M Y');
            $data['revenue'][] = $revenue;
            $data['expenses'][] = $cogs;
            $data['profit'][] = $revenue - $cogs;
        }
        return $data;
    }

    private function getTopProducts($dateRange)
    {
        return InvoiceItem::whereHas('invoice', function ($query) use ($dateRange) {
                $query->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                      ->where('status', 'paid');
            })
            ->with('product')
            ->select('product_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_sales'))
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->limit(5)
            ->get();
    }

    private function getCustomerStats($dateRange)
    {
        return [
            'total' => Customer::count(),
            'new' => Customer::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->count(),
            'active' => Invoice::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                ->distinct('customer_id')
                ->count('customer_id'),
        ];
    }

    private function getInvoiceStats($dateRange)
    {
        $stats = Invoice::query()
            ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) as paid")
            ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending")
            ->selectRaw("SUM(CASE WHEN status = 'overdue' THEN 1 ELSE 0 END) as overdue")
            ->first();

        return [
            'total' => (int) ($stats->total ?? 0),
            'paid' => (int) ($stats->paid ?? 0),
            'pending' => (int) ($stats->pending ?? 0),
            'overdue' => (int) ($stats->overdue ?? 0),
        ];
    }
}
