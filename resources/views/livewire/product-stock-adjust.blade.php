<div>
    @if($showModal)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Adjust Stock: {{ $product->name }}</h3>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600">Current Stock: <span class="font-medium">{{ $product->stock }}</span></p>
            </div>
            
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Type</label>
                    <select wire:model="type" class="w-full border-gray-300 rounded-lg">
                        <option value="in">Stock In (+)</option>
                        <option value="out">Stock Out (-)</option>
                        <option value="adjust">Adjust (Set)</option>
                    </select>
                    @error('type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-1">Quantity</label>
                    <input type="number" wire:model="qty" 
                        class="w-full border-gray-300 rounded-lg" 
                        placeholder="Enter quantity">
                    @error('qty') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-1">Notes</label>
                    <textarea wire:model="notes" rows="3" 
                        class="w-full border-gray-300 rounded-lg"
                        placeholder="Optional notes"></textarea>
                    @error('notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex gap-2 justify-end">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
