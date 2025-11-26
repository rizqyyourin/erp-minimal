<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    public function createInvoice(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Calculate totals
            $subtotal = 0;
            foreach ($data['items'] as $item) {
                $subtotal += $item['qty'] * $item['price'];
            }

            $taxRate = $data['tax_rate'] ?? 11;
            $discount = $data['discount'] ?? 0;
            $tax = ($subtotal - $discount) * ($taxRate / 100);
            $total = $subtotal - $discount + $tax;

            // Create invoice
            $invoice = Invoice::create([
                'tenant_id' => 1,
                'customer_id' => $data['customer_id'],
                'title' => $data['title'] ?? null,
                'reference' => $data['reference'] ?? null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax' => $tax,
                'total' => $total,
                'status' => $data['status'] ?? 'pending',
                'due_date' => $data['due_date'],
                'payment_method' => $data['payment_method'] ?? null,
            ]);

            // Create invoice items and reduce stock
            foreach ($data['items'] as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);

                // Check stock availability
                if ($product->stock < $itemData['qty']) {
                    throw new \Exception("Insufficient stock for product: {$product->name}");
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
                    'tenant_id' => 1,
                    'product_id' => $product->id,
                    'qty' => -$itemData['qty'],
                    'type' => 'out',
                    'reference_type' => 'invoice',
                    'reference_id' => $invoice->id,
                    'notes' => "Stock reduced for invoice {$invoice->invoice_number}",
                ]);
            }

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
                    'tenant_id' => 1,
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
