<div>
    <div class="space-y-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex gap-3 items-start bg-gray-50 p-4 rounded-lg">
            <div class="flex-1">
                <label class="block text-sm font-medium mb-1">Product</label>
                <select wire:model.live="items.<?php echo e($index); ?>.product_id" class="w-full border-gray-300 rounded-lg">
                    <option value="">Select product</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> (Stock: <?php echo e($product->stock); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>
            
            <div class="w-24">
                <label class="block text-sm font-medium mb-1">Qty</label>
                <input type="number" wire:model.blur="items.<?php echo e($index); ?>.qty" min="1" 
                    class="w-full border-gray-300 rounded-lg">
            </div>
            
            <div class="w-32">
                <label class="block text-sm font-medium mb-1">Price</label>
                <input type="number" wire:model.blur="items.<?php echo e($index); ?>.price" step="0.01" min="0"
                    class="w-full border-gray-300 rounded-lg">
            </div>
            
            <div class="w-32">
                <label class="block text-sm font-medium mb-1">Subtotal</label>
                <input type="text" value="<?php echo e(number_format($item['subtotal'], 2)); ?>" readonly
                    class="w-full border-gray-300 rounded-lg bg-gray-100">
            </div>
            
            <button type="button" wire:click="removeItem(<?php echo e($index); ?>)" 
                class="mt-7 text-red-600 hover:text-red-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    
    <button type="button" wire:click="addItem" 
        class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        + Add Item
    </button>
    
    <div class="mt-6 border-t pt-4 space-y-2">
        <div class="flex justify-between text-sm">
            <span>Subtotal:</span>
            <span class="font-medium">Rp <?php echo e(number_format($this->subtotal, 2)); ?></span>
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
            <span>Rp <?php echo e(number_format($this->total, 2)); ?></span>
        </div>
    </div>
    
    <!-- Hidden inputs for form submission -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="items[<?php echo e($index); ?>][product_id]" value="<?php echo e($item['product_id']); ?>">
        <input type="hidden" name="items[<?php echo e($index); ?>][qty]" value="<?php echo e($item['qty']); ?>">
        <input type="hidden" name="items[<?php echo e($index); ?>][price]" value="<?php echo e($item['price']); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <input type="hidden" name="discount" value="<?php echo e($discount); ?>">
    <input type="hidden" name="tax" value="<?php echo e($tax); ?>">
</div>
<?php /**PATH D:\Kerjaan\Laravel\erp\resources\views\livewire\invoice-form.blade.php ENDPATH**/ ?>