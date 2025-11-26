@props(['label' => '', 'value' => '', 'meta' => null, 'trend' => null])

<div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-sm">
    <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">{{ $label }}</p>
    <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $value }}</p>
    @if($meta)
        <p class="mt-2 text-sm text-slate-500">{{ $meta }}</p>
    @endif
    @if($trend)
        <div class="mt-3 inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
            <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12l5 5L20 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>{{ $trend }}</span>
        </div>
    @endif
</div>
