@php
    $role = session('role', 'publik');
    $roleLabel = ['publik' => 'Publik', 'operator' => 'Operator', 'admin' => 'Admin'][$role] ?? 'Publik';
    $current = '/' . trim(request()->path(), '/');
@endphp

<header class="sticky top-0 z-40 border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
    <div class="mx-auto flex h-16 max-w-(--breakpoint-2xl) items-center gap-6 px-4 md:px-6">
        <a href="{{ url('/') }}" class="flex shrink-0 items-center gap-2 font-bold text-gray-800 dark:text-white/90">
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-brand-500 text-white">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 10 13.5 10 13.5"/></svg>
            </span>
            <span class="leading-tight">
                <span class="block text-base">Rimbawan</span>
                <span class="block text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">RBP REDD+ GCF · Sumbar</span>
            </span>
        </a>

        <nav class="flex flex-1 gap-1 overflow-x-auto">
            <a href="{{ url('/') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition-colors duration-150 {{ $current === '/' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400' : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90' }}">
                Beranda
            </a>
            <a href="{{ route('dashboard') }}"
               class="rounded-lg px-3 py-2 text-sm font-medium transition-colors duration-150 {{ $current === '/dashboard' ? 'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400' : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90' }}">
                Dashboard
            </a>
        </nav>

        @if ($role !== 'publik')
            <a href="{{ route('workspace.index') }}"
               class="hidden shrink-0 items-center gap-1.5 rounded-full bg-brand-500 px-4 py-2 text-xs font-bold text-white transition-all duration-150 hover:bg-brand-600 hover:gap-2.5 active:scale-95 sm:flex">
                Ruang Kerja
                <svg class="stroke-current transition-transform rtl:rotate-180" width="14" height="14" viewBox="0 0 17 16" fill="none"><path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </a>
        @endif

        <button @click="$store.theme.toggle()" class="hidden shrink-0 rounded-lg border border-gray-200 p-2 text-gray-500 transition-colors duration-150 hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/5 sm:flex">
            <svg x-show="$store.theme.theme === 'light'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -rotate-45 scale-50" x-transition:enter-end="opacity-100 rotate-0 scale-100" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.36 6.36-.7-.7M6.34 6.34l-.7-.7m12.02 0-.7.7M6.34 17.66l-.7.7M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <svg x-show="$store.theme.theme === 'dark'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 rotate-45 scale-50" x-transition:enter-end="opacity-100 rotate-0 scale-100" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>

        <div class="flex shrink-0 items-center gap-2">
            <span class="rounded-full border border-gray-200 px-2.5 py-1 text-[11px] font-semibold text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $roleLabel }}</span>
            <form method="POST" id="roleForm" action="{{ url('/role/' . $role) }}">
                @csrf
                <x-form.native-select size="sm" class="w-44"
                    onchange="document.getElementById('roleForm').action = '/role/' + this.value; document.getElementById('roleForm').submit();">
                    <option value="publik" @selected($role === 'publik')>Lihat sebagai: Publik</option>
                    <option value="operator" @selected($role === 'operator')>Lihat sebagai: Operator</option>
                    <option value="admin" @selected($role === 'admin')>Lihat sebagai: Admin</option>
                </x-form.native-select>
            </form>
        </div>
    </div>
</header>
