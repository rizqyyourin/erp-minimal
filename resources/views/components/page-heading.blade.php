@props(['title', 'description' => null])

<div class="mb-8 flex flex-col gap-4 border-b border-slate-100 pb-5 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Overview</p>
        <h1 class="text-2xl font-semibold text-slate-900">{{ $title }}</h1>
        @if($description)
            <p class="mt-2 text-sm text-slate-500">{{ $description }}</p>
        @endif
    </div>
    @if(isset($actions))
        <div class="flex flex-wrap gap-3">
            {{ $actions }}
        </div>
    @endif
</div>
