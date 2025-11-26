<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get recent invoices (last 5)
        $recentInvoices = Invoice::with('customer')
            ->latest()
            ->take(5)
            ->get();
        
        // Get critical stock items (stock <= min_stock or stock < 5)
        $criticalStock = Product::where(function($query) {
            $query->whereColumn('stock', '<=', 'min_stock')
                  ->orWhere('stock', '<', 5);
        })
        ->orderBy('stock', 'asc')
        ->take(5)
        ->get();
        
        // Calculate stats
        $stats = [
            'mrr' => Payment::whereMonth('created_at', now()->month)
                ->sum('amount'),
            'outstanding_invoices_count' => Invoice::where('status', 'pending')->count(),
            'outstanding_invoices_amount' => Invoice::where('status', 'pending')->sum('total'),
            'low_stock_count' => Product::whereColumn('stock', '<=', 'min_stock')->count(),
            'payments_today_amount' => Payment::whereDate('created_at', today())->sum('amount'),
            'payments_today_count' => Payment::whereDate('created_at', today())->count(),
        ];
        
        return view('dashboard', compact('recentInvoices', 'criticalStock', 'stats', 'user'));
    }
}
