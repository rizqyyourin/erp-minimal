<div>
    <div class="space-y-4">
        @foreach($items as $index => $item)
        <div class="flex gap-3 items-start bg-gray-50 p-4 rounded-lg">
            <div class="flex-1">
                <label class="block text-sm font-medium mb-1">Product</label>
                <select wire:model.live="items.{{ $index }}.product_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">Select product</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>
            
            <div class="w-24">
                <label class="block text-sm font-medium mb-1">Qty</label>
                <input type="number" wire:model.blur="items.{{ $index }}.qty" min="1" 
                    class="w-full border-gray-300 rounded-lg">
            </div>
            
            <div class="w-32">
                <label class="block text-sm font-medium mb-1">Price</label>
                <input type="number" wire:model.blur="items.{{ $index }}.price" step="0.01" min="0"
                    class="w-full border-gray-300 rounded-lg">
            </div>
            
            <div class="w-32">
                <label class="block text-sm font-medium mb-1">Subtotal</label>
                <input type="text" value="{{ number_format($item['subtotal'], 2) }}" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100">
            </div>
            
            <button type="button" wire:click="removeItem({{ $index }})" 
                class="mt-7 text-red-600 hover:text-red-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @endforeach
    </div>
    
    <button type="button" wire:click="addItem" 
        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        + Add Item
    </button>
    
    <div class="mt-6 border-t pt-4 space-y-2">
        <div class="flex justify-between text-sm">
            <span>Subtotal:</span>
            <span class="font-medium">Rp {{ number_format($this->subtotal, 2) }}</span>
        </div>
        
        <div class="flex justify-between items-center text-sm">
            <span>Discount:</span>
            <input type="number" wire:model.live="discount" step="0.01" min="0"
                class="w-32 border-gray-300 rounded-lg text-right">
        </div>
        
        <div class="flex justify-between items-center text-sm">
            <span>Tax:</span>
            <input type="number" wire:model.live="tax" step="0.01" min="0"
                class="w-32 border-gray-300 rounded-lg text-right">
        </div>
        
        <div class="flex justify-between text-lg font-bold pt-2 border-t">
            <span>Total:</span>
            <span>Rp {{ number_format($this->total, 2) }}</span>
        </div>
    </div>
    
    <!-- Hidden inputs for form submission -->
    @foreach($items as $index => $item)
        <input type="hidden" name="items[{{ $index }}][product_id]" value="{{ $item['product_id'] }}">
        <input type="hidden" name="items[{{ $index }}][qty]" value="{{ $item['qty'] }}">
        <input type="hidden" name="items[{{ $index }}][price]" value="{{ $item['price'] }}">
    @endforeach
    <input type="hidden" name="discount" value="{{ $discount }}">
    <input type="hidden" name="tax" value="{{ $tax }}">
</div>
