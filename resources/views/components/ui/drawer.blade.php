@props([
    'isOpen' => false,
])

<div x-data="{
    open: @js($isOpen),
    init() {
        this.$watch('open', value => {
            document.body.style.overflow = value ? 'hidden' : 'unset';
        });
    }
}" x-show="open" x-cloak @keydown.escape.window="open = false" {{ $attributes->except('class') }}>

    <!-- Backdrop -->
    <div @click="open = false" class="fixed inset-0 z-99999 h-full w-full bg-gray-400/50 backdrop-blur-xs dark:bg-gray-900/70"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    <!-- Drawer panel -->
    <div @click.stop
        class="fixed inset-y-0 z-99999 flex h-full w-full max-w-md flex-col overflow-y-auto bg-white dark:bg-gray-900 ltr:right-0 rtl:left-0 {{ $attributes->get('class') }}"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="ltr:translate-x-full rtl:-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="ltr:translate-x-full rtl:-translate-x-full">

        <button @click="open = false" class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white rtl:right-auto rtl:left-4">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.04 16.54a1 1 0 0 0 1.42 1.42L12 13.41l4.54 4.55a1 1 0 0 0 1.42-1.42L13.41 12l4.55-4.54a1 1 0 0 0-1.42-1.42L12 10.59 7.46 6.04a1 1 0 0 0-1.42 1.42L10.59 12l-4.55 4.54Z" fill="currentColor"/></svg>
        </button>

        {{ $slot }}
    </div>
</div>
