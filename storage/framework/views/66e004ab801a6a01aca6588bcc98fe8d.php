

<?php $__env->startSection('title', 'Overview'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'Today','description' => 'Snapshot of sales, cashflow, and stock health']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Today','description' => 'Snapshot of sales, cashflow, and stock health']); ?>
         <?php $__env->slot('actions', null, []); ?> 
            <a href="<?php echo e(route('invoices.create')); ?>" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New invoice</a>
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

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'MRR','value' => 'Rp '.e(number_format($stats['mrr'], 0, ',', '.')).'','meta' => 'this month']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'MRR','value' => 'Rp '.e(number_format($stats['mrr'], 0, ',', '.')).'','meta' => 'this month']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Outstanding invoices','value' => ''.e($stats['outstanding_invoices_count']).'','meta' => 'Rp '.e(number_format($stats['outstanding_invoices_amount'], 0, ',', '.')).' due']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Outstanding invoices','value' => ''.e($stats['outstanding_invoices_count']).'','meta' => 'Rp '.e(number_format($stats['outstanding_invoices_amount'], 0, ',', '.')).' due']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Low stock','value' => ''.e($stats['low_stock_count']).' items','meta' => 'Need attention']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Low stock','value' => ''.e($stats['low_stock_count']).' items','meta' => 'Need attention']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['label' => 'Payments today','value' => 'Rp '.e(number_format($stats['payments_today_amount'], 0, ',', '.')).'','meta' => ''.e($stats['payments_today_count']).' payments']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Payments today','value' => 'Rp '.e(number_format($stats['payments_today_amount'], 0, ',', '.')).'','meta' => ''.e($stats['payments_today_count']).' payments']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
    </div>

    <div class="mt-10 grid gap-6 lg:grid-cols-2">
        <section class="rounded-3xl border border-slate-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Pipeline</p>
                    <h2 class="text-lg font-semibold text-slate-900">Recent Invoices</h2>
                </div>
                <a href="<?php echo e(route('invoices.create')); ?>" class="text-sm font-semibold text-slate-500 hover:text-slate-900">View all</a>
            </div>
            <div class="mt-6 space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('invoices.show', $invoice)); ?>" class="flex items-center justify-between rounded-2xl border border-slate-100 px-4 py-3 hover:border-slate-200 transition">
                        <div>
                            <p class="text-sm font-semibold text-slate-900"><?php echo e($invoice->invoice_number); ?></p>
                            <p class="text-xs text-slate-500"><?php echo e($invoice->customer->name); ?></p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="rounded-full px-3 py-1 text-xs font-medium 
                                <?php echo e($invoice->status === 'paid' ? 'bg-emerald-50 text-emerald-700' : 
                                   ($invoice->status === 'pending' ? 'bg-amber-50 text-amber-700' : 
                                   ($invoice->status === 'partial' ? 'bg-blue-50 text-blue-700' : 'bg-slate-50 text-slate-700'))); ?>">
                                <?php echo e(ucfirst($invoice->status)); ?>

                            </span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-slate-900">Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></p>
                                <p class="text-xs text-slate-500"><?php echo e($invoice->due_date->format('d M Y')); ?></p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-8 text-center">
                        <p class="text-sm text-slate-500">No invoices yet</p>
                        <a href="<?php echo e(route('invoices.create')); ?>" class="mt-2 inline-block text-sm font-semibold text-slate-900">Create your first invoice</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>
        <section class="rounded-3xl border border-slate-100 bg-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Stock watch</p>
                    <h2 class="text-lg font-semibold text-slate-900">Critical items</h2>
                </div>
                <a href="<?php echo e(route('inventory.index')); ?>" class="text-sm font-semibold text-slate-500 hover:text-slate-900">View details</a>
            </div>
            <div class="mt-6 divide-y divide-slate-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $criticalStock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between py-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-900"><?php echo e($product->name); ?></p>
                            <p class="text-xs text-slate-500">SKU <?php echo e($product->sku); ?></p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-semibold text-slate-900"><?php echo e($product->stock); ?> pcs</span>
                            <span class="rounded-full px-3 py-1 text-xs font-medium 
                                <?php echo e($product->stock > $product->min_stock ? 'bg-emerald-50 text-emerald-700' : 
                                   ($product->stock > 0 ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700')); ?>">
                                <?php echo e($product->stock > $product->min_stock ? 'Healthy' : ($product->stock > 0 ? 'Low' : 'Critical')); ?>

                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="py-8 text-center">
                        <p class="text-sm text-slate-500">All stock levels are healthy</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views/dashboard.blade.php ENDPATH**/ ?>