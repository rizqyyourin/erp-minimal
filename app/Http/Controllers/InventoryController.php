<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function index(Request $request)
    {
        $query = InventoryTransaction::with(['product']);

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        $transactions = $query->latest()->paginate(30);
        $products = Product::orderBy('name')->get();

        return view('inventory.index', compact('transactions', 'products'));
    }

    public function adjust(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|not_in:0',
            'type' => 'required|in:in,out,adjust',
            'notes' => 'nullable|string',
        ]);

        try {
            $validated['tenant_id'] = 1;
            $this->inventoryService->adjustStock($validated);

            return back()->with('success', 'Stock adjusted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
