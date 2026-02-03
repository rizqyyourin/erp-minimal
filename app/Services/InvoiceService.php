<?php

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use App\Models\InventoryTransaction;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    private function calculateSubtotal(array $items): float
    {
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += $item['qty'] * $item['price'];
        }

        return $subtotal;
    }

    private function calculateTotals(array $data): array
    {
        $subtotal = $this->calculateSubtotal($data['items']);
        $taxRate = $data['tax_rate'] ?? Config::get('app.tax_rate', 11);
        $discount = $data['discount'] ?? 0;
        $tax = ($subtotal - $discount) * ($taxRate / 100);
        $total = $subtotal - $discount + $tax;

        return compact('subtotal', 'tax', 'total', 'discount', 'taxRate');
    }

    private function createInvoiceItems(Invoice $invoice, array $items): void
    {
        foreach ($items as $itemData) {
            $product = Product::findOrFail($itemData['product_id']);

            // Check stock availability
            if ($product->stock < $itemData['qty']) {
                throw new InsufficientStockException($product->name, $product->stock, $itemData['qty']);
            }

            // Create invoice item
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'subtotal' => $itemData['qty'] * $itemData['price'],
            ]);

            // Reduce stock
            $product->decrement('stock', $itemData['qty']);

            // Log inventory transaction
            InventoryTransaction::create([
                'product_id' => $product->id,
                'qty' => -$itemData['qty'],
                'type' => 'out',
                'reference_type' => 'invoice',
                'reference_id' => $invoice->id,
                'notes' => "Stock reduced for invoice {$invoice->invoice_number}",
            ]);
        }
    }

    public function createInvoice(array $data)
    {
        return DB::transaction(function () use ($data) {
            $totals = $this->calculateTotals($data);

            // Create invoice
            $invoice = Invoice::create([
                'customer_id' => $data['customer_id'],
                'title' => $data['title'] ?? null,
                'reference' => $data['reference'] ?? null,
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['discount'],
                'tax' => $totals['tax'],
                'total' => $totals['total'],
                'status' => $data['status'] ?? 'pending',
                'due_date' => $data['due_date'],
                'payment_method' => $data['payment_method'] ?? null,
            ]);

            // Create invoice items and reduce stock
            $this->createInvoiceItems($invoice, $data['items']);

            return $invoice->load(['items.product', 'customer']);
        });
    }

    public function updateInvoice(Invoice $invoice, array $data)
    {
        return DB::transaction(function () use ($invoice, $data) {
            // Revert stock for old items first
            foreach ($invoice->items as $item) {
                $product = Product::findOrFail($item->product_id);
                $product->increment('stock', $item->qty);

                // Log inventory transaction for revert
                InventoryTransaction::create([
                    'product_id' => $product->id,
                    'qty' => $item->qty,
                    'type' => 'adjust',
                    'reference_type' => 'invoice_update',
                    'reference_id' => $invoice->id,
                    'notes' => "Stock reverted for invoice update {$invoice->invoice_number}",
                ]);
            }

            // Delete old items
            $invoice->items()->delete();

            // Calculate new totals
            $totals = $this->calculateTotals($data);

            // Update invoice header
            $invoice->update([
                'customer_id' => $data['customer_id'],
                'title' => $data['title'] ?? null,
                'reference' => $data['reference'] ?? null,
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['discount'],
                'tax' => $totals['tax'],
                'total' => $totals['total'],
                'status' => $data['status'] ?? 'pending',
                'due_date' => $data['due_date'],
                'payment_method' => $data['payment_method'] ?? null,
            ]);

            // Create new invoice items and reduce stock
            $this->createInvoiceItems($invoice, $data['items']);

            return $invoice->load(['items.product', 'customer']);
        });
    }

    public function cancelInvoice(Invoice $invoice)
    {
        return DB::transaction(function () use ($invoice) {
            // Revert stock for each item
            foreach ($invoice->items as $item) {
                $product = Product::findOrFail($item->product_id);
                $product->increment('stock', $item->qty);

                // Log inventory transaction
                InventoryTransaction::create([
                    'product_id' => $product->id,
                    'qty' => $item->qty,
                    'type' => 'in',
                    'reference_type' => 'invoice_cancel',
                    'reference_id' => $invoice->id,
                    'notes' => "Stock reverted from cancelled invoice {$invoice->invoice_number}",
                ]);
            }

            $invoice->update(['status' => 'cancelled']);

            return $invoice;
        });
    }

    public function recordPayment(Invoice $invoice, array $data)
    {
        return DB::transaction(function () use ($invoice, $data) {
            $payment = $invoice->payments()->create($data);

            // Update invoice status based on total paid
            $totalPaid = $invoice->payments()->sum('amount');

            if ($totalPaid >= $invoice->total) {
                $invoice->update(['status' => 'paid']);
            } elseif ($totalPaid > 0) {
                $invoice->update(['status' => 'partial']);
            }

            return $payment;
        });
    }
}
