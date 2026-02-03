<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Product;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(Request $request)
    {
        $query = Invoice::with('customer');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('invoice_number', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%')
                  ->orWhereHas('customer', function ($cq) use ($request) {
                      $cq->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        $invoices = $query->latest()->paginate(20);

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $productsForJs = $products->map(function($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'price' => $p->price,
                'stock' => $p->stock,
            ];
        });

        return view('invoices.create', compact('customers', 'products', 'productsForJs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:100',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'due_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Validate stock availability before creating invoice
        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            if ($product->stock < $item['qty']) {
                return back()->withInput()
                    ->withErrors(['error' => "Insufficient stock for product: {$product->name}. Available: {$product->stock}, Required: {$item['qty']}"]);
            }
        }

        try {
            $invoice = $this->invoiceService->createInvoice($validated);

            return redirect()->route('invoices.show', $invoice->id)
                ->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'items.product', 'payments']);

        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if (in_array($invoice->status, ['paid', 'cancelled'])) {
            return redirect()->route('invoices.show', $invoice->id)
                ->with('error', 'Cannot edit paid or cancelled invoices.');
        }

        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $invoice->load('items.product');

        return view('invoices.edit', compact('invoice', 'customers', 'products'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if (in_array($invoice->status, ['paid', 'cancelled'])) {
            return redirect()->route('invoices.show', $invoice->id)
                ->with('error', 'Cannot update paid or cancelled invoices.');
        }

        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'title' => 'nullable|string|max:255',
            'reference' => 'nullable|string|max:100',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'due_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'status' => 'required|in:draft,pending,partial,paid,overdue,cancelled',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        // Validate stock availability for new items (accounting for current stock + returned stock)
        $currentItems = $invoice->items->keyBy('product_id');
        foreach ($validated['items'] as $item) {
            $product = Product::findOrFail($item['product_id']);
            $currentQty = $currentItems[$item['product_id']]->qty ?? 0;
            $availableStock = $product->stock + $currentQty; // Stock now + what will be returned
            
            if ($availableStock < $item['qty']) {
                return back()->withInput()
                    ->withErrors(['error' => "Insufficient stock for product: {$product->name}. Available: {$availableStock}, Required: {$item['qty']}"]);
            }
        }

        try {
            $invoice = $this->invoiceService->updateInvoice($invoice, $validated);

            return redirect()->route('invoices.show', $invoice->id)
                ->with('success', 'Invoice updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->status !== 'draft') {
            return redirect()->route('invoices.index')
                ->with('error', 'Only draft invoices can be deleted.');
        }

        try {
            DB::transaction(function () use ($invoice) {
                // Revert stock for items
                foreach ($invoice->items as $item) {
                    $product = Product::findOrFail($item->product_id);
                    $product->increment('stock', $item->qty);
                }
                
                $invoice->items()->delete();
                $invoice->delete();
            });

            return redirect()->route('invoices.index')
                ->with('success', 'Invoice deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function cancel(Invoice $invoice)
    {
        if ($invoice->status === 'cancelled') {
            return back()->with('error', 'Invoice is already cancelled.');
        }

        try {
            $this->invoiceService->cancelInvoice($invoice);

            return back()->with('success', 'Invoice cancelled and stock reverted.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
