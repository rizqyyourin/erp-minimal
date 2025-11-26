

<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'Customers','description' => 'Keep billing info lightweight and clean']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Customers','description' => 'Keep billing info lightweight and clean']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('customers.create')); ?>" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New customer</a>
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

    <div class="grid gap-6 lg:grid-cols-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $outstanding = $customer->invoices()->whereNotIn('status', ['paid','cancelled'])->sum('total');
            ?>
            <div class="rounded-3xl border border-slate-100 bg-white p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-base font-semibold text-slate-900"><?php echo e($customer->name); ?></p>
                        <p class="text-xs text-slate-500"><?php echo e($customer->email); ?></p>
                    </div>
                    <span class="rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-600">Customer</span>
                </div>
                <div class="mt-4 space-y-2 text-sm text-slate-600">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customer->phone): ?>
                        <p><?php echo e($customer->phone); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Outstanding</p>
                    <p class="text-lg font-semibold text-slate-900">Rp <?php echo e(number_format($outstanding,0,',','.')); ?></p>
                </div>
                <div class="mt-4 flex justify-end gap-3">
                    <a href="<?php echo e(route('customers.show',$customer)); ?>" class="rounded-2xl border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:border-slate-300">View</a>
                    <a href="<?php echo e(route('invoices.create', ['customer_id' => $customer->id])); ?>" class="rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">Invoice</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 rounded-3xl border border-dashed border-slate-200 bg-white p-12 text-center">
                <p class="text-sm text-slate-500">No customers yet</p>
                <a href="<?php echo e(route('customers.create')); ?>" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800">Add first customer</a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views/customers/index.blade.php ENDPATH**/ ?>