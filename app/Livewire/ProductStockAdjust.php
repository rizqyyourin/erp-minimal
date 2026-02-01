<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Services\InventoryService;

class ProductStockAdjust extends Component
{
    public $showModal = false;
    public $product;
    public $qty = 0;
    public $type = 'adjust';
    public $notes = '';

    protected $inventoryService;

    protected $rules = [
        'qty' => 'required|integer|not_in:0',
        'type' => 'required|in:in,out,adjust',
        'notes' => 'nullable|string',
    ];

    public function boot(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    public function openModal($productId)
    {
        $this->product = Product::findOrFail($productId);
        $this->showModal = true;
        $this->reset(['qty', 'type', 'notes']);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['product', 'qty', 'type', 'notes']);
    }

    public function save()
    {
        $this->validate();

        try {
            $this->inventoryService->adjustStock([
                'product_id' => $this->product->id,
                'qty' => $this->qty,
                'type' => $this->type,
                'notes' => $this->notes,
            ]);

            session()->flash('success', 'Stock adjusted successfully.');
            $this->closeModal();
            $this->dispatch('stockAdjusted');
        } catch (\Exception $e) {
            $this->addError('qty', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.product-stock-adjust');
    }
}
