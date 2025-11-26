<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minimal ERP • Modern SaaS ERP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        night: '#0f172a',
                        accent: '#6366f1',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" integrity="sha512-w2pexnox96M1gL0Ija+K1Pc1HoF4DW/xFcKpKwlBW7P0mF7ZvDP7i0jPqsd5ZSvkijYEaqaQ3+r4o8IyYH0nNQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="min-h-full bg-white font-sans text-slate-900">
    <div class="relative">
        <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-slate-200 text-sm font-semibold">ER</div>
                <div>
                    <p class="text-sm font-semibold">Minimal ERP</p>
                    <p class="text-xs text-slate-500">Multi-tenant SaaS</p>
                </div>
            </div>
            <nav class="hidden items-center gap-6 text-sm text-slate-500 md:flex">
                <a href="#features" class="hover:text-slate-900">Features</a>
                <a href="#modules" class="hover:text-slate-900">Modules</a>
                <a href="#pricing" class="hover:text-slate-900">Pricing</a>
                <a href="#faq" class="hover:text-slate-900">FAQ</a>
            </nav>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('login')); ?>" class="hidden rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300 md:inline-flex">Log in</a>
                <a href="<?php echo e(route('register')); ?>" class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Start free trial</a>
            </div>
        </header>

        <section class="mx-auto mt-10 max-w-5xl px-6 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">Flat • Modular • SaaS</p>
            <h1 class="mt-4 text-4xl font-semibold leading-tight text-slate-900 sm:text-5xl">Modern ERP stack for sales, inventory, and master data—without the clutter.</h1>
            <p class="mt-4 text-base text-slate-600">
                Ship your MVP faster with Laravel, Blade, Tailwind, Flowbite, and Livewire. Multi-tenant ready, roles-aware, and delightful to use.
            </p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="<?php echo e(route('register')); ?>" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">Start free trial</a>
                <a href="#modules" class="rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-slate-300">Learn more</a>
            </div>
        </section>

        <section id="features" class="mx-auto mt-24 max-w-6xl px-6">
            <div class="grid gap-6 md:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [
                    ['title' => 'Multi-tenant core', 'body' => 'Single database, tenant scoped tables, ready for billing plans.'],
                    ['title' => 'Livewire UI', 'body' => 'Dynamic invoice builder and stock adjustments with minimal JS.'],
                    ['title' => 'Tailwind + Flowbite', 'body' => 'Flat, minimal components built with production-ready utility classes.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6">
                        <p class="text-sm font-semibold text-slate-900"><?php echo e($feature['title']); ?></p>
                        <p class="mt-2 text-sm text-slate-600"><?php echo e($feature['body']); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

        <section id="modules" class="mx-auto mt-24 max-w-6xl px-6">
            <div class="rounded-3xl border border-slate-200 bg-white">
                <div class="grid gap-0 md:grid-cols-2">
                    <div class="p-10">
                        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Modules</p>
                        <h2 class="mt-3 text-3xl font-semibold text-slate-900">Sales & Inventory, simplified</h2>
                        <p class="mt-4 text-sm text-slate-600">Products, customers, suppliers, invoices, and payments—modular yet cohesive. Inventory transactions keep everything in sync.</p>
                        <ul class="mt-6 space-y-3 text-sm text-slate-700">
                            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-slate-900"></span> Livewire invoice form with dynamic rows</li>
                            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-slate-900"></span> Stock in/out/adjust timeline</li>
                            <li class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-slate-900"></span> Role-based navigation per tenant</li>
                        </ul>
                    </div>
                    <div class="border-t border-slate-100 md:border-l md:border-t-0">
                        <div class="grid gap-6 p-10">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [
                                ['label' => 'Products', 'desc' => 'Master data with SKU, pricing, and stock thresholds.'],
                                ['label' => 'Invoices', 'desc' => 'Invoice items, payments, and automated stock deduction.'],
                                ['label' => 'Inventory', 'desc' => 'Transaction log with references to invoices or manual adjustments.'],
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="rounded-2xl border border-slate-100 p-5">
                                    <p class="text-sm font-semibold text-slate-900"><?php echo e($module['label']); ?></p>
                                    <p class="mt-2 text-sm text-slate-500"><?php echo e($module['desc']); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="mx-auto mt-24 max-w-4xl px-6 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Pricing</p>
            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Start free, grow with confidence</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-8 text-left">
                    <p class="text-sm font-semibold text-slate-500">Starter</p>
                    <p class="mt-4 text-4xl font-semibold text-slate-900">Rp 0</p>
                    <p class="text-sm text-slate-500">Up to 2 tenants • 5 users • 500 invoices</p>
                    <ul class="mt-6 space-y-3 text-sm text-slate-700">
                        <li>Products, customers, suppliers</li>
                        <li>Invoices + payments</li>
                        <li>Manual inventory adjustments</li>
                    </ul>
                    <a href="<?php echo e(route('dashboard')); ?>" class="mt-8 inline-flex rounded-full border border-slate-200 px-5 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Launch free</a>
                </div>
                <div class="rounded-3xl border border-slate-900 bg-slate-900 text-white p-8 text-left">
                    <p class="text-sm font-semibold text-white/70">Growth</p>
                    <p class="mt-4 text-4xl font-semibold">Rp 1,5 jt<span class="text-base text-white/60">/tenant</span></p>
                    <p class="text-sm text-white/80">Unlimited users • Priority support</p>
                    <ul class="mt-6 space-y-3 text-sm text-white">
                        <li>Automation webhooks</li>
                        <li>Advanced role policies</li>
                        <li>API & audit logs</li>
                    </ul>
                    <a href="#contact" class="mt-8 inline-flex rounded-full bg-white px-5 py-2 text-sm font-semibold text-slate-900">Book a call</a>
                </div>
            </div>
        </section>

        <section id="faq" class="mx-auto mt-24 max-w-3xl px-6">
            <div class="rounded-3xl border border-slate-200 bg-white p-8">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">FAQ</p>
                <div class="mt-6 space-y-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = [
                        ['q' => 'How does multi-tenancy work?', 'a' => 'We use a single database with tenant_id guarding every record plus middleware to scope queries. Ready for future sharding.'],
                        ['q' => 'Can I self-host?', 'a' => 'Yes. The stack uses Laravel 11 + Breeze, so you can deploy to any PHP 8.3 environment.'],
                        ['q' => 'Is there billing integration?', 'a' => 'Stripe/Paddle ready via Laravel Cashier, but kept optional for MVP scope.'],
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <p class="text-sm font-semibold text-slate-900"><?php echo e($faq['q']); ?></p>
                            <p class="mt-2 text-sm text-slate-600"><?php echo e($faq['a']); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </section>

        <section id="contact" class="mx-auto my-24 max-w-4xl rounded-3xl border border-slate-200 bg-white p-10 text-center">
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">Ready?</p>
            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Spin up your ERP MVP today</h2>
            <p class="mt-3 text-sm text-slate-600">Invite your first tenant in minutes. Breeze auth + spatie/permission already wired.</p>
            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-center">
                <a href="<?php echo e(route('dashboard')); ?>" class="rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white">Enter app</a>
                <a href="mailto:hi@minimal-erp.app" class="rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700">Talk to us</a>
            </div>
        </section>

        <footer class="border-t border-slate-100">
            <div class="mx-auto flex max-w-6xl flex-col gap-3 px-6 py-6 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>© <?php echo e(date('Y')); ?> Minimal ERP. <a href="https://yourin.my.id" target="_blank" class="text-indigo-600 hover:underline">Yourin</a></p>
                <p>Laravel • Tailwind • Livewire</p>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js" integrity="sha512-Ogk8Y2cQhUJQF6UVx/F4WRzE7dHGnkvVGnzlQozY1UIQQCN7PCKt3ztBwF1j5R4d0RyYP1UFDoNFuIBqmoeVdg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
<?php /**PATH D:\Kerjaan\Laravel\erp\resources\views/landing.blade.php ENDPATH**/ ?>