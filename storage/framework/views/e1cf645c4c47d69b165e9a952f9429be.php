<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['href' => '#', 'label' => '', 'active' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['href' => '#', 'label' => '', 'active' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $baseClasses = 'group flex items-center gap-3 rounded-2xl px-4 py-2 text-sm font-semibold transition';
    $stateClasses = $active
        ? 'bg-slate-900 text-white shadow-sm'
        : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900';
?>

<a href="<?php echo e($href); ?>" class="<?php echo e($baseClasses); ?> <?php echo e($stateClasses); ?>">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim($slot)): ?>
        <span class="text-slate-400 group-hover:text-slate-200">
            <?php echo e($slot); ?>

        </span>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <span><?php echo e($label); ?></span>
</a>
<?php /**PATH D:\Kerjaan\Laravel\erp\resources\views\components\sidebar-link.blade.php ENDPATH**/ ?>