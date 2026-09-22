<footer class="relative overflow-hidden border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-linear-to-r from-transparent via-brand-400/60 to-transparent"></div>

    <div class="mx-auto max-w-(--breakpoint-2xl) px-4 py-16 md:px-6 md:py-20">
        <div class="grid gap-x-12 gap-y-12 sm:grid-cols-[1.4fr_1fr_1fr]">
            <div>
                <a href="{{ url('/') }}" class="flex items-center gap-2 font-bold text-gray-800 dark:text-white/90">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-brand-500 text-white">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 10 13.5 10 13.5"/></svg>
                    </span>
                    <span class="text-base">Rimbawan</span>
                </a>
                <p class="mt-4 max-w-[34ch] text-sm italic text-gray-500 dark:text-gray-400">Merajut satu cerita untuk hutan Sumatera Barat.</p>
                <p class="mt-3 max-w-[36ch] text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                    Sistem informasi pengelolaan data &amp; pengetahuan Program RBP REDD+ GCF Output 2 — dikelola KKI WARSI, Provinsi Sumatera Barat.
                </p>
            </div>

            <div>
                <h4 class="mb-5 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Tautan</h4>
                <ul class="flex flex-col gap-4 text-sm text-gray-500 dark:text-gray-400">
                    <li><a href="{{ url('/') }}" class="transition-colors hover:text-brand-500">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}" class="transition-colors hover:text-brand-500">Dashboard Capaian</a></li>
                    <li><a href="{{ url('/#publikasi') }}" class="transition-colors hover:text-brand-500">Publikasi</a></li>
                    <li><span class="text-gray-400 dark:text-gray-600">Tentang Program</span></li>
                </ul>
            </div>

            <div>
                <h4 class="mb-5 text-xs font-bold uppercase tracking-wider text-gray-400 dark:text-gray-500">Kontak</h4>
                <ul class="flex flex-col gap-4 text-sm text-gray-500 dark:text-gray-400">
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 shrink-0 text-brand-500" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.5-7-11a7 7 0 1 1 14 0c0 4.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        <span>KKI WARSI Sumatera Barat</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 shrink-0 text-brand-500" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 6 10 7L22 6"/></svg>
                        <a href="mailto:info@warsi.example.org" class="transition-colors hover:text-brand-500">info@warsi.example.org</a>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <svg class="mt-0.5 shrink-0 text-brand-500" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 4 5v6c0 5 3.4 8.7 8 11 4.6-2.3 8-6 8-11V5z"/></svg>
                        <span>Kebijakan Privasi</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-100 dark:border-gray-800">
        <div class="mx-auto flex max-w-(--breakpoint-2xl) flex-wrap items-center justify-between gap-3 px-4 py-6 text-xs text-gray-400 dark:text-gray-500 md:px-6">
            <span>© 2026 KKI WARSI · Didukung Green Climate Fund (GCF)</span>
            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 font-medium text-gray-500 dark:bg-white/5 dark:text-gray-400">Prototipe UI non-final</span>
        </div>
    </div>
</footer>
