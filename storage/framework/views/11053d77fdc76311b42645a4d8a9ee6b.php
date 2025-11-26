

<?php $__env->startSection('title', 'Create Invoice'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6">
        <a href="<?php echo e(route('invoices.index')); ?>" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-slate-900">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to invoices
        </a>
    </div>

    <?php if (isset($component)) { $__componentOriginal8026f1991abb42645b4d7cc7ace47942 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8026f1991abb42645b4d7cc7ace47942 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-heading','data' => ['title' => 'New Invoice','description' => 'Generate clean invoices and sync stock movements']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'New Invoice','description' => 'Generate clean invoices and sync stock movements']); ?>
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

    <form method="POST" action="<?php echo e(route('invoices.store')); ?>" id="invoice-form">
        <?php echo csrf_field(); ?>
        
        <div class="grid gap-6 lg:grid-cols-3">
            <section class="lg:col-span-2 rounded-3xl border border-slate-100 bg-white p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Details</p>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="customer_id" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Customer</label>
                        <select name="customer_id" id="customer_id" required
                            class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-slate-300 focus:bg-white focus:outline-none">
                            <option value="">Choose customer</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>" <?php echo e(request('customer_id') == $c->id ? 'selected' : ''); ?>><?php echo e($c->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <label for="due_date" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Due date</label>
                        <input type="date" name="due_date" id="due_date" value="<?php echo e(old('due_date', date('Y-m-d'))); ?>" min="<?php echo e(date('Y-m-d')); ?>"
                            class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-slate-300 focus:bg-white focus:outline-none">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <label for="title" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Invoice title</label>
                        <input name="title" id="title" type="text" value="<?php echo e(old('title')); ?>"
                            class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-slate-300 focus:bg-white focus:outline-none">
                    </div>
                    <div>
                        <label for="reference" class="text-xs font-semibold uppercase tracking-wide text-slate-500">Reference</label>
                        <input name="reference" id="reference" type="text" value="<?php echo e(old('reference')); ?>"
                            class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:border-slate-300 focus:bg-white focus:outline-none">
                    </div>
                </div>

                <div class="mt-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Line items</p>
                            <h3 class="text-lg font-semibold text-slate-900">Products & bundles</h3>
                        </div>
                        <button type="button" onclick="addLineItem()" class="inline-flex items-center gap-2 rounded-2xl border border-dashed border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:border-slate-400">
                            <span>+ Add item</span>
                        </button>
                    </div>
                    <div class="mt-4 space-y-3" id="line-items">
                        <div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center text-sm text-slate-500" id="empty-state">
                            <p>No items added yet. Click "+ Add item" to start.</p>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="rounded-3xl border border-slate-100 bg-slate-900/95 p-6 text-white">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Summary</p>
                <div class="mt-4 space-y-4 text-sm">
                    <div class="flex items-center justify-between">
                        <span>Subtotal</span>
                        <span id="subtotal">Rp 0</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Tax (0%)</span>
                        <span id="tax">Rp 0</span>
                    </div>
                    <hr class="border-white/10">
                    <div class="flex items-center justify-between text-base font-semibold">
                        <span>Total due</span>
                        <span id="total">Rp 0</span>
                    </div>
                </div>

                <div class="mt-8 space-y-3">
                    <button type="submit" class="w-full rounded-2xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 hover:bg-slate-100">
                        Create Invoice
                    </button>
                    <a href="<?php echo e(route('invoices.index')); ?>" class="block w-full rounded-2xl border border-white/20 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-white/10">
                        Cancel
                    </a>
                </div>
            </aside>
        </div>
    </form>

    <script>
        let itemIndex = 0;
        const products = <?php echo json_encode($productsForJs, 15, 512) ?>;

        function addLineItem() {
            const emptyState = document.getElementById('empty-state');
            if (emptyState) emptyState.remove();

            const container = document.getElementById('line-items');
            const item = document.createElement('div');
            item.className = 'grid gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 md:grid-cols-12';
            item.id = `item-${itemIndex}`;
            
            item.innerHTML = `
                <div class="md:col-span-5">
                    <select name="items[${itemIndex}][product_id]" required onchange="updatePrice(${itemIndex}, this.value)"
                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                        <option value="">Select product</option>
                        ${products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name} (Stock: ${p.stock})</option>`).join('')}
                    </select>
                </div>
                <div class="md:col-span-2">
                    <input type="number" name="items[${itemIndex}][qty]" placeholder="Qty" required min="1" value="1"
                        onchange="updateTotal()" oninput="updateTotal()"
                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                </div>
                <div class="md:col-span-3">
                    <input type="number" name="items[${itemIndex}][price]" placeholder="Price" required min="0" step="0.01"
                        onchange="updateTotal()" oninput="updateTotal()"
                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none">
                </div>
                <div class="md:col-span-2 flex items-center justify-end">
                    <button type="button" onclick="removeLineItem(${itemIndex})"
                        class="rounded-xl border border-red-300 px-3 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">
                        Remove
                    </button>
                </div>
            `;
            
            container.appendChild(item);
            itemIndex++;
            updateTotal();
        }

        function removeLineItem(index) {
            const item = document.getElementById(`item-${index}`);
            if (item) {
                item.remove();
                updateTotal();
                
                // Show empty state if no items
                const container = document.getElementById('line-items');
                if (container.children.length === 0) {
                    container.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-200 p-8 text-center text-sm text-slate-500" id="empty-state"><p>No items added yet. Click "+ Add item" to start.</p></div>';
                }
            }
        }

        function updatePrice(index, productId) {
            const product = products.find(p => p.id == productId);
            if (product) {
                const priceInput = document.querySelector(`#item-${index} input[name="items[${index}][price]"]`);
                if (priceInput) {
                    priceInput.value = product.price;
                    updateTotal();
                }
            }
        }

        function updateTotal() {
            let subtotal = 0;
            
            document.querySelectorAll('#line-items > div[id^="item-"]').forEach(item => {
                const qty = parseFloat(item.querySelector('input[type="number"][placeholder="Qty"]')?.value || 0);
                const price = parseFloat(item.querySelector('input[type="number"][placeholder="Price"]')?.value || 0);
                subtotal += qty * price;
            });

            const tax = 0; // Tax calculation can be added here
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('tax').textContent = 'Rp ' + tax.toLocaleString('id-ID');
            document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Auto-add one item on page load if customer is pre-selected
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('customer_id')): ?>
            addLineItem();
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kerjaan\Laravel\erp\resources\views/invoices/create.blade.php ENDPATH**/ ?>