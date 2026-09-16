@props([
    'size' => 'md',
    'invalid' => false,
])

@php
    $sizeClass = $size === 'sm'
        ? 'h-8 py-1.5 pl-3 pr-8 text-xs'
        : 'h-9 py-2 pl-3 pr-9 text-sm';
    $iconSize = $size === 'sm' ? 'w-3.5 h-3.5' : 'w-4 h-4';
    $iconPos = $size === 'sm' ? 'right-2.5' : 'right-3';
    $borderClass = $invalid
        ? 'border-error-400 dark:border-error-500/60'
        : 'border-gray-200 dark:border-gray-700';
@endphp

<div class="relative">
    <select {{ $attributes->class([
        'w-full appearance-none rounded-lg border bg-transparent bg-none text-gray-700 shadow-theme-xs',
        'focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden',
        'dark:bg-gray-900 dark:text-gray-300',
        $borderClass,
        $sizeClass,
    ]) }}>
        {{ $slot }}
    </select>
    <span class="pointer-events-none absolute top-1/2 {{ $iconPos }} -translate-y-1/2 text-gray-500 dark:text-gray-400 rtl:right-auto rtl:left-3">
        <svg class="{{ $iconSize }} stroke-current" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>
</div>
