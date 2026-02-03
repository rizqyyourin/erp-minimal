@props(['href' => '#', 'label' => '', 'active' => false, 'permission' => null])

@php
    $user = auth()->user();
    if ($permission && (!$user || !$user->hasPermission($permission))) {
        return;
    }
    
    $baseClasses = 'group flex items-center gap-3 rounded-2xl px-4 py-2 text-sm font-semibold transition';
    $stateClasses = $active
        ? 'bg-slate-900 text-white shadow-sm'
        : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900';
@endphp

<a href="{{ $href }}" class="{{ $baseClasses }} {{ $stateClasses }}">
    @if(trim($slot))
        <span class="text-slate-400 group-hover:text-slate-200">
            {{ $slot }}
        </span>
    @endif
    <span>{{ $label }}</span>
</a>
