<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function store(Request $request, Invoice $invoice)
    {
        // Check if invoice can accept payments
        if (in_array($invoice->status, ['cancelled', 'draft'])) {
            return back()->with('error', 'Cannot record payment for cancelled or draft invoices.');
        }

        // Check if invoice is already fully paid
        $totalPaid = $invoice->payments()->sum('amount');
        $remainingBalance = $invoice->total - $totalPaid;

        if ($remainingBalance <= 0) {
            return back()->with('error', 'Invoice is already fully paid.');
        }

        $validated = $request->validate([
            'amount' => [
                'required', 
                'numeric', 
                'min:0.01',
                'max:' . $remainingBalance // Prevent overpayment
            ],
            'method' => 'required|in:cash,transfer,card,giro',
            'paid_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $validated['paid_at'] = $validated['paid_at'] ?? now();

        try {
            $this->invoiceService->recordPayment($invoice, $validated);

            return back()->with('success', 'Payment recorded successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
