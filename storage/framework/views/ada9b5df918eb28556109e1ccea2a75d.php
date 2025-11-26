

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'Invoices','subtitle' => 'Sales invoices and payment tracking','category' => 'Sales']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Invoices','subtitle' => 'Sales invoices and payment tracking','category' => 'Sales']); ?>
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
    <div class="flex justify-between items-center mb-6">
        <form method="GET" class="flex gap-3">
            <select name="status" class="h-10 rounded-2xl border border-slate-200 pl-4 pr-8 text-sm appearance-none bg-white">
                <option value="">All Status</option>
                <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
                <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="partial" <?php echo e(request('status') == 'partial' ? 'selected' : ''); ?>>Partial</option>
                <option value="paid" <?php echo e(request('status') == 'paid' ? 'selected' : ''); ?>>Paid</option>
                <option value="overdue" <?php echo e(request('status') == 'overdue' ? 'selected' : ''); ?>>Overdue</option>
                <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
            </select>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" 
                placeholder="Search invoices..." 
                class="rounded-2xl border border-slate-200 px-4 py-2 text-sm">
            <button type="submit" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                Filter
            </button>
        </form>
        <a href="<?php echo e(route('invoices.create')); ?>" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
            + New Invoice
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-100">
        <table class="min-w-full divide-y divide-slate-100 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Invoice #</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Due Date</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-6 py-4 font-semibold"><?php echo e($invoice->invoice_number); ?></td>
                    <td class="px-6 py-4"><?php echo e($invoice->customer->name); ?></td>
                    <td class="px-6 py-4">Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></td>
                    <td class="px-6 py-4">
                        <span class="rounded-full px-3 py-1 text-xs font-semibold 
                            <?php if($invoice->status === 'paid'): ?> bg-emerald-50 text-emerald-700
                            <?php elseif($invoice->status === 'cancelled'): ?> bg-rose-50 text-rose-700
                            <?php elseif($invoice->status === 'partial'): ?> bg-amber-50 text-amber-700
                            <?php else: ?> bg-slate-50 text-slate-700
                            <?php endif; ?>">
                            <?php echo e(ucfirst($invoice->status)); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4"><?php echo e($invoice->due_date?->format('d M Y') ?? '-'); ?></td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo e(route('invoices.show', $invoice)); ?>" 
                            class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">
                            View
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        No invoices found
                    </td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($invoices->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views/invoices/index.blade.php ENDPATH**/ ?>