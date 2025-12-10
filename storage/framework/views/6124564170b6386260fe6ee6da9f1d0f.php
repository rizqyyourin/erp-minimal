

<?php $__env->startSection('title', 'Inventory'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'Inventory Movements','description' => 'Single timeline for stock in/out/adjust']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Inventory Movements','description' => 'Single timeline for stock in/out/adjust']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <div class="flex items-center gap-2">
                <form method="GET" action="<?php echo e(route('inventory.index')); ?>" class="flex gap-2">
                    <select name="type" class="rounded-xl border border-slate-200 bg-white pl-4 pr-8 py-2 h-10 text-sm text-slate-700 leading-tight">
                        <option value="">All types</option>
                        <option value="in" <?php echo e(request('type') == 'in' ? 'selected' : ''); ?>>Stock In</option>
                        <option value="out" <?php echo e(request('type') == 'out' ? 'selected' : ''); ?>>Stock Out</option>
                        <option value="adjust" <?php echo e(request('type') == 'adjust' ? 'selected' : ''); ?>>Adjust</option>
                    </select>
                    <select name="product_id" class="rounded-xl border border-slate-200 bg-white pl-4 pr-8 py-2 h-10 text-sm text-slate-700 leading-tight">
                        <option value="">All products</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->id); ?>" <?php echo e(request('product_id') == $product->id ? 'selected' : ''); ?>><?php echo e($product->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                    <button type="submit" class="rounded-xl border border-slate-200 bg-white px-4 py-2 h-10 text-sm font-semibold text-slate-700 hover:border-slate-300">Filter</button>
                </form>
                <a href="<?php echo e(route('inventory.adjust')); ?>" class="rounded-2xl bg-slate-900 px-4 py-2 h-10 text-sm font-semibold text-white hover:bg-slate-800 flex items-center">+ Manual adjust</a>
            </div>
         <?php $__env->endSlot(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8026f1991abb42645b4d7cc7ace47942)): ?>
<?php $attributes = $__attributesOriginal8026f1991abb42645b4d7cc7ace47942; ?>
<?php unset($__attributesOriginal8026f1991abb42645b4d7cc7ace47942); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8026f1991abb42645b4d7cc7ace47942)): ?>
<?php $component = $__componentOriginal8026f1991abb42645b4d7cc7ace47942; ?>
<?php unset($__componentOriginal8026f1991abb42645b4d7cc7ace47942); ?>
<?php endif; ?>

    <div class="rounded-3xl border border-slate-100 bg-white p-6">
        <div class="space-y-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex flex-col gap-4 rounded-2xl border border-slate-100 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl <?php echo e($trx->type === 'in' ? 'bg-emerald-50 text-emerald-700' : ($trx->type === 'out' ? 'bg-amber-50 text-amber-700' : 'bg-indigo-50 text-indigo-700')); ?> font-semibold uppercase"><?php echo e($trx->type); ?></span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900"><?php echo e($trx->product->name ?? 'Unknown product'); ?></p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trx->product): ?>
                                <p class="text-xs text-slate-500">SKU <?php echo e($trx->product->sku); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-lg font-semibold text-slate-900"><?php echo e($trx->qty); ?> pcs</p>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trx->notes): ?>
                                <p class="text-xs text-slate-500"><?php echo e($trx->notes); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <p class="text-xs text-slate-400"><?php echo e($trx->created_at->diffForHumans()); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="rounded-2xl border border-dashed border-slate-200 p-10 text-center">
                    <p class="text-sm text-slate-500">No inventory movements yet</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views\inventory\index.blade.php ENDPATH**/ ?>