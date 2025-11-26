

<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'Product Catalog','description' => 'Master data shared across tenants, kept deliberately clean']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Product Catalog','description' => 'Master data shared across tenants, kept deliberately clean']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('products.create')); ?>" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New product</a>
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

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)]">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="<?php echo e(route('products.index')); ?>" class="flex gap-3">
                <div class="relative">
                    <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                    </span>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search product or SKU" class="rounded-2xl border border-slate-200 bg-slate-50 pl-9 pr-3 py-2 text-sm focus:border-slate-300 focus:bg-white focus:outline-none">
                </div>
            </form>
            <a href="<?php echo e(route('inventory.index')); ?>" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">View inventory</a>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-3 text-left">Product</th>
                        <th class="px-6 py-3 text-left">SKU</th>
                        <th class="px-6 py-3 text-left">Cost</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3 text-left">Stock</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-6 py-4 text-slate-900">
                                <p class="font-semibold"><?php echo e($product->name); ?></p>
                                <p class="text-xs text-slate-500">SKU <?php echo e($product->sku); ?></p>
                            </td>
                            <td class="px-6 py-4 text-slate-500"><?php echo e($product->sku); ?></td>
                            <td class="px-6 py-4 text-slate-900">Rp <?php echo e(number_format($product->cost,0,',','.')); ?></td>
                            <td class="px-6 py-4 text-slate-900">Rp <?php echo e(number_format($product->price,0,',','.')); ?></td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-900"><?php echo e($product->stock); ?> pcs</span>
                            </td>
                            <td class="px-6 py-4">
                                <?php
                                    $status = $product->stock > $product->min_stock ? 'Active' : ($product->stock > 0 ? 'Low stock' : 'Critical');
                                ?>
                                <span class="rounded-full px-3 py-1 text-xs font-semibold <?php echo e($status === 'Active' ? 'bg-emerald-50 text-emerald-700' : ($status === 'Low stock' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700')); ?>"><?php echo e($status); ?></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="<?php echo e(route('products.edit', $product)); ?>" class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <p class="text-sm text-slate-500">No products yet</p>
                                <a href="<?php echo e(route('products.create')); ?>" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Add your first product</a>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views/products/index.blade.php ENDPATH**/ ?>