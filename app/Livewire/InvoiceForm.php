<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class InvoiceForm extends Component
{
    public $items = [];
    public $products;
    public $discount = 0;
    public $tax = 0;

    public function mount()
    {
        $this->products = Product::orderBy('name')->get();
        $this->addItem();
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'qty' => 1,
            'price' => 0,
            'subtotal' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function updatedItems($value, $key)
    {
        // Parse key like "0.product_id" or "1.qty"
        $parts = explode('.', $key);
        $index = $parts[0];
        $field = $parts[1] ?? null;

        if ($field === 'product_id') {
            $product = Product::find($value);
            if ($product) {
                $this->items[$index]['price'] = $product->price;
            }
        }

        // Calculate subtotal
        if (isset($this->items[$index]['qty']) && isset($this->items[$index]['price'])) {
            $this->items[$index]['subtotal'] = $this->items[$index]['qty'] * $this->items[$index]['price'];
        }
    }

    public function getSubtotalProperty()
    {
        return collect($this->items)->sum('subtotal');
    }

    public function getTotalProperty()
    {
        return $this->subtotal - $this->discount + $this->tax;
    }

    public function render()
    {
        return view('livewire.invoice-form');
    }
}
