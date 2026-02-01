<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Product;
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
        
        $monthlyData = $this->getMonthlyData($dateRange['start']);
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
        return DB::table('inventory_transactions')
            ->where('type', 'adjust')
            ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
            ->sum(DB::raw('ABS(qty)'));
    }

    private function getMonthlyData($startDate)
    {
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            $month = $startDate->copy()->addMonths($i);
            $revenue = Payment::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('amount');
            
            $data['labels'][] = $month->format('M Y');
            $data['revenue'][] = $revenue;
            $data['profit'][] = $revenue * 0.7;
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
        return [
            'total' => Invoice::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])->count(),
            'paid' => Invoice::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                ->where('status', 'paid')->count(),
            'pending' => Invoice::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                ->where('status', 'pending')->count(),
            'overdue' => Invoice::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                ->where('status', 'overdue')->count(),
        ];
    }
}
