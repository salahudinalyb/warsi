@php
    $role = session('role', 'publik');
    $roleLabel = ['publik' => 'Publik', 'operator' => 'Operator', 'admin' => 'Admin'][$role] ?? 'Publik';
    $current = '/' . trim(request()->path(), '/');
    $links = [
        [url('/'), '/', 'Beranda'],
        [route('dashboard'), '/dashboard', 'Dashboard'],
    ];
    $activeClass = 'bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400';
    $idleClass = 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white/90';
@endphp

<header x-data="{ menuOpen: false }" @keydown.escape.window="menuOpen = false" @click.outside="menuOpen = false"
        class="sticky top-0 z-40 border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
    <div class="mx-auto flex h-16 max-w-(--breakpoint-2xl) items-center gap-4 px-4 md:px-6 lg:gap-6">
        <a href="{{ url('/') }}" class="flex min-w-0 shrink-0 items-center gap-2 font-bold text-gray-800 dark:text-white/90">
            <img src="{{ asset('images/logo/sumbar.png') }}" alt="Lambang Sumatera Barat" class="h-9 w-9 shrink-0 object-contain">
            <span class="leading-tight">
                <span class="block text-base">Rimbawan</span>
                <span class="block text-[10px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">RBP REDD+ GCF · Sumbar</span>
            </span>
        </a>

        <nav class="hidden flex-1 gap-1 lg:flex">
            @foreach ($links as [$href, $path, $label])
                <a href="{{ $href }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium transition-colors duration-150 {{ $current === $path ? $activeClass : $idleClass }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        @if ($role !== 'publik')
            <a href="{{ route('workspace.index') }}"
               class="hidden shrink-0 items-center gap-1.5 rounded-full bg-brand-500 px-4 py-2 text-xs font-bold text-white transition-all duration-150 hover:bg-brand-600 hover:gap-2.5 active:scale-95 lg:flex">
                Ruang Kerja
                <svg class="stroke-current transition-transform rtl:rotate-180" width="14" height="14" viewBox="0 0 17 16" fill="none"><path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /></svg>
            </a>
        @endif

        <button @click="$store.theme.toggle()" aria-label="Ganti tema" class="ms-auto flex shrink-0 rounded-lg border border-gray-200 p-2 text-gray-500 transition-colors duration-150 hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/5 lg:ms-0">
            <svg x-show="$store.theme.theme === 'light'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -rotate-45 scale-50" x-transition:enter-end="opacity-100 rotate-0 scale-100" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.36 6.36-.7-.7M6.34 6.34l-.7-.7m12.02 0-.7.7M6.34 17.66l-.7.7M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <svg x-show="$store.theme.theme === 'dark'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 rotate-45 scale-50" x-transition:enter-end="opacity-100 rotate-0 scale-100" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>

        <div class="hidden shrink-0 items-center gap-2 lg:flex">
            <span class="rounded-full border border-gray-200 px-2.5 py-1 text-[11px] font-semibold text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $roleLabel }}</span>
            <form method="POST" action="{{ url('/role/' . $role) }}">
                @csrf
                <x-form.native-select size="sm" class="w-44"
                    onchange="this.form.action = '/role/' + this.value; this.form.submit();">
                    <option value="publik" @selected($role === 'publik')>Lihat sebagai: Publik</option>
                    <option value="operator" @selected($role === 'operator')>Lihat sebagai: Operator</option>
                    <option value="admin" @selected($role === 'admin')>Lihat sebagai: Admin</option>
                </x-form.native-select>
            </form>
        </div>

        <button @click="menuOpen = !menuOpen" :aria-expanded="menuOpen" aria-controls="mobileNav" aria-label="Buka menu"
                class="flex shrink-0 rounded-lg border border-gray-200 p-2 text-gray-500 transition-colors duration-150 hover:bg-gray-50 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/5 lg:hidden">
            <svg x-show="!menuOpen" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="menuOpen" x-cloak width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
        </button>
    </div>

    {{-- mobile menu --}}
    <div id="mobileNav" x-show="menuOpen" x-cloak
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="absolute inset-x-0 top-full border-b border-gray-200 bg-white shadow-theme-lg dark:border-gray-800 dark:bg-gray-900 lg:hidden">
        <div class="mx-auto flex max-w-(--breakpoint-2xl) flex-col gap-1 px-4 py-4 md:px-6">
            @foreach ($links as [$href, $path, $label])
                <a href="{{ $href }}"
                   class="rounded-lg px-3 py-2.5 text-sm font-medium transition-colors duration-150 {{ $current === $path ? $activeClass : $idleClass }}">
                    {{ $label }}
                </a>
            @endforeach

            @if ($role !== 'publik')
                <a href="{{ route('workspace.index') }}"
                   class="mt-2 flex items-center justify-center gap-1.5 rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-bold text-white transition-colors duration-150 hover:bg-brand-600 active:scale-[0.98]">
                    Ruang Kerja
                    <svg class="stroke-current rtl:rotate-180" width="14" height="14" viewBox="0 0 17 16" fill="none"><path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </a>
            @endif

            <div class="mt-3 border-t border-gray-100 pt-4 dark:border-gray-800">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-[10.5px] font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">Peran aktif</span>
                    <span class="rounded-full border border-gray-200 px-2.5 py-1 text-[11px] font-semibold text-gray-500 dark:border-gray-700 dark:text-gray-400">{{ $roleLabel }}</span>
                </div>
                <form method="POST" action="{{ url('/role/' . $role) }}">
                    @csrf
                    <x-form.native-select
                        onchange="this.form.action = '/role/' + this.value; this.form.submit();">
                        <option value="publik" @selected($role === 'publik')>Lihat sebagai: Publik</option>
                        <option value="operator" @selected($role === 'operator')>Lihat sebagai: Operator</option>
                        <option value="admin" @selected($role === 'admin')>Lihat sebagai: Admin</option>
                    </x-form.native-select>
                </form>
            </div>
        </div>
    </div>
</header>
