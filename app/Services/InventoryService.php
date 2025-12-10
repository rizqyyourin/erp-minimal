<?php

namespace App\Services;

use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function adjustStock(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::findOrFail($data['product_id']);

            // Apply stock adjustment
            if ($data['type'] === 'in') {
                $product->increment('stock', abs($data['qty']));
            } elseif ($data['type'] === 'out') {
                if ($product->stock < abs($data['qty'])) {
                    throw new \Exception("Insufficient stock for adjustment");
                }
                $product->decrement('stock', abs($data['qty']));
            } elseif ($data['type'] === 'adjust') {
                $product->update(['stock' => $data['qty']]);
            }

            // Log transaction
            $transaction = InventoryTransaction::create([
                'product_id' => $product->id,
                'qty' => $data['type'] === 'out' ? -abs($data['qty']) : abs($data['qty']),
                'type' => $data['type'],
                'notes' => $data['notes'] ?? 'Manual stock adjustment',
            ]);

            return $transaction->load('product');
        });
    }
}
