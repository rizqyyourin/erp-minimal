

<?php $__env->startSection('content'); ?>
<?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'Invoice Details','subtitle' => 'View invoice details and payments','category' => 'Sales']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Invoice Details','subtitle' => 'View invoice details and payments','category' => 'Sales']); ?>
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
    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-3xl border border-slate-100 bg-white p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold"><?php echo e($invoice->invoice_number); ?></h2>
                    <p class="text-sm text-slate-500"><?php echo e($invoice->title); ?></p>
                </div>
                <span class="rounded-full px-4 py-2 text-sm font-semibold
                    <?php if($invoice->status === 'paid'): ?> bg-emerald-50 text-emerald-700
                    <?php elseif($invoice->status === 'cancelled'): ?> bg-rose-50 text-rose-700
                    <?php else: ?> bg-amber-50 text-amber-700
                    <?php endif; ?>">
                    <?php echo e(ucfirst($invoice->status)); ?>

                </span>
            </div>

            <div class="mb-6">
                <p class="text-xs uppercase tracking-wide text-slate-400">Customer</p>
                <p class="text-lg font-semibold"><?php echo e($invoice->customer->name); ?></p>
                <p class="text-sm text-slate-500"><?php echo e($invoice->customer->email); ?></p>
            </div>

            <table class="w-full text-sm">
                <thead class="border-b">
                    <tr>
                        <th class="pb-3 text-left text-xs uppercase">Product</th>
                        <th class="pb-3 text-right text-xs uppercase">Qty</th>
                        <th class="pb-3 text-right text-xs uppercase">Price</th>
                        <th class="pb-3 text-right text-xs uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b">
                        <td class="py-3"><?php echo e($item->product->name); ?></td>
                        <td class="py-3 text-right"><?php echo e($item->qty); ?></td>
                        <td class="py-3 text-right">Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></td>
                        <td class="py-3 text-right font-semibold">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="pt-4 text-right">Subtotal:</td>
                        <td class="pt-4 text-right">Rp <?php echo e(number_format($invoice->subtotal, 0, ',', '.')); ?></td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invoice->discount > 0): ?>
                    <tr>
                        <td colspan="3" class="text-right">Discount:</td>
                        <td class="text-right text-red-600">-Rp <?php echo e(number_format($invoice->discount, 0, ',', '.')); ?></td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <tr>
                        <td colspan="3" class="text-right">Tax:</td>
                        <td class="text-right">Rp <?php echo e(number_format($invoice->tax, 0, ',', '.')); ?></td>
                    </tr>
                    <tr class="border-t-2">
                        <td colspan="3" class="pt-3 text-right text-lg font-bold">Total:</td>
                        <td class="pt-3 text-right text-lg font-bold">Rp <?php echo e(number_format($invoice->total, 0, ',', '.')); ?></td>
                    </tr>
                    <?php
                        $totalPaid = $invoice->payments->sum('amount');
                        $remaining = $invoice->total - $totalPaid;
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalPaid > 0): ?>
                    <tr>
                        <td colspan="3" class="pt-2 text-right text-emerald-600">Paid:</td>
                        <td class="pt-2 text-right text-emerald-600">Rp <?php echo e(number_format($totalPaid, 0, ',', '.')); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="pt-1 text-right font-bold <?php echo e($remaining > 0 ? 'text-rose-600' : 'text-emerald-600'); ?>">Remaining:</td>
                        <td class="pt-1 text-right font-bold <?php echo e($remaining > 0 ? 'text-rose-600' : 'text-emerald-600'); ?>">Rp <?php echo e(number_format($remaining, 0, ',', '.')); ?></td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tfoot>
            </table>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invoice->payments->count() > 0): ?>
        <div class="rounded-3xl border border-slate-100 bg-white p-6">
            <h3 class="text-lg font-semibold mb-4">Payment History</h3>
            <div class="space-y-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex justify-between items-center p-3 bg-slate-50 rounded-2xl">
                    <div>
                        <p class="font-semibold">Rp <?php echo e(number_format($payment->amount, 0, ',', '.')); ?></p>
                        <p class="text-xs text-slate-500"><?php echo e($payment->paid_at->format('d M Y H:i')); ?> • <?php echo e(ucfirst($payment->method)); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="space-y-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invoice->status !== 'paid' && $invoice->status !== 'cancelled'): ?>
        <?php
            $paidAmount = $invoice->payments->sum('amount');
            $remainingAmount = $invoice->total - $paidAmount;
        ?>
        <div class="rounded-3xl border border-slate-100 bg-white p-6">
            <h3 class="text-lg font-semibold mb-4">Record Payment</h3>
            <div class="mb-4 p-3 bg-amber-50 rounded-2xl text-sm">
                <p class="text-amber-700">Remaining: <strong>Rp <?php echo e(number_format($remainingAmount, 0, ',', '.')); ?></strong></p>
            </div>
            <form method="POST" action="<?php echo e(route('payments.store', $invoice)); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-medium mb-1">Amount</label>
                    <input type="number" name="amount" step="0.01" required
                        class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm"
                        value="<?php echo e($remainingAmount); ?>"
                        max="<?php echo e($remainingAmount); ?>"
                        placeholder="0.00">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Method</label>
                    <select name="method" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="card">Card</option>
                        <option value="giro">Giro</option>
                    </select>
                </div>
                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                    Record Payment
                </button>
            </form>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($invoice->status !== 'cancelled' && $invoice->status !== 'paid'): ?>
        <div class="rounded-3xl border border-rose-100 bg-white p-6">
            <h3 class="text-lg font-semibold mb-4 text-rose-700">Cancel Invoice</h3>
            <p class="text-sm text-slate-500 mb-4">This will revert stock changes</p>
            <form method="POST" action="<?php echo e(route('invoices.cancel', $invoice)); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full rounded-2xl border border-rose-600 px-4 py-2 text-sm font-semibold text-rose-700 hover:bg-rose-50"
                    onclick="return confirm('Are you sure?')">
                    Cancel Invoice
                </button>
            </form>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views\invoices\show.blade.php ENDPATH**/ ?>