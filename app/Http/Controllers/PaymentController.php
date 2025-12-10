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
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
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
