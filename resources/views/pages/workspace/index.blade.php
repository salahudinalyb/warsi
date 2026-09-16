@extends('layouts.app')

@php
    use App\Models\Lokasi;
    $kategoriLabel = Lokasi::KATEGORI_LABEL;
    $bulanLabel = Lokasi::BULAN_LABEL;
    $role = session('role');
@endphp

@section('content')
    @php
        $headerIcon = match (true) {
            str_contains($title, 'Kehutanan') => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 10 13.5 10 13.5"/>',
            str_contains($title, 'Program') => '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"/>',
            str_contains($title, 'Monitoring') => '<path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>',
            str_contains($title, 'Tinjauan') => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
            str_contains($title, 'Tayang') => '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/>',
            str_contains($title, 'Ditolak') => '<circle cx="12" cy="12" r="9"/><path d="m15 9-6 6M9 9l6 6"/>',
            default => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        };
    @endphp

    <div class="relative mb-6 rounded-2xl border border-gray-200 bg-linear-to-br from-white to-gray-50 p-5 dark:border-gray-800 dark:from-gray-900 dark:to-gray-900/60 md:p-6">
        {{-- survey-plot corner marks --}}
        <span class="pointer-events-none absolute -left-px -top-px h-4 w-4 rounded-tl-[15px] border-l-2 border-t-2 border-brand-500"></span>
        <span class="pointer-events-none absolute -right-px -top-px h-4 w-4 rounded-tr-[15px] border-r-2 border-t-2 border-brand-500"></span>
        <span class="pointer-events-none absolute -bottom-px -left-px h-4 w-4 rounded-bl-[15px] border-b-2 border-l-2 border-brand-500"></span>
        <span class="pointer-events-none absolute -bottom-px -right-px h-4 w-4 rounded-br-[15px] border-b-2 border-r-2 border-brand-500"></span>

        <nav class="mb-4 flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-gray-400 dark:text-gray-500">
            <a href="{{ url('/') }}" class="transition-colors hover:text-brand-500">Home</a>
            <svg width="10" height="10" viewBox="0 0 16 16" fill="none" class="shrink-0 text-gray-300 dark:text-gray-600"><path d="M6 3l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <span class="font-semibold text-brand-600 dark:text-brand-400">{{ $title }}</span>
        </nav>

        <div class="flex flex-wrap items-end justify-between gap-4">
            <div class="flex items-start gap-4">
                <div class="relative flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-linear-to-br from-brand-50 to-brand-100 text-brand-600 ring-1 ring-inset ring-brand-200/70 dark:from-brand-500/20 dark:to-brand-500/5 dark:text-brand-400 dark:ring-brand-500/20">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $headerIcon !!}</svg>
                </div>
                <div>
                    <h1 class="text-title-sm font-bold leading-tight text-gray-800 dark:text-white/90">{{ $title }}</h1>
                    <p class="mt-1.5 max-w-[56ch] text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                        Ruang kerja Operator untuk menginput data lapangan, dan bagi Admin untuk meninjau sebelum tayang publik.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden items-baseline gap-1.5 rounded-lg border border-brand-200/70 bg-brand-50/40 px-3.5 py-2 font-mono dark:border-brand-500/20 dark:bg-brand-500/5 sm:flex">
                    <span class="text-lg font-bold tabular-nums text-brand-600 dark:text-brand-400">{{ $lokasi->total() }}</span>
                    <span class="text-xs text-gray-400">entri</span>
                </div>
                <button @click="$dispatch('open-drawer')" class="group inline-flex items-center gap-2 rounded-lg bg-linear-to-b from-brand-400 to-brand-600 px-4 py-2.5 text-sm font-medium text-white shadow-theme-md transition-all duration-150 hover:shadow-lg hover:shadow-brand-500/25 active:scale-[0.97]">
                    <svg class="transition-transform duration-200 group-hover:rotate-90" width="16" height="16" viewBox="0 0 20 20" fill="none"><path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    Tambah Data
                </button>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div class="animate-fade-up mb-5 rounded-lg border border-success-200 bg-success-50 px-4 py-3 text-sm text-success-700 dark:border-success-500/20 dark:bg-success-500/10 dark:text-success-400">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-3">
        {{-- card: Total Data --}}
        <div class="animate-fade-up [perspective:1200px]" style="animation-delay:60ms">
            <div
                x-data="{ mx:'50%', my:'50%', rx:0, ry:0,
                    move(e){
                        const r = $el.getBoundingClientRect();
                        const px = (e.clientX - r.left) / r.width, py = (e.clientY - r.top) / r.height;
                        this.mx = (px * 100) + '%'; this.my = (py * 100) + '%';
                        this.rx = (py - 0.5) * -8; this.ry = (px - 0.5) * 8;
                    },
                    reset(){ this.rx = 0; this.ry = 0; }
                }"
                @mousemove="move($event)" @mouseleave="reset()"
                :style="`transform: perspective(1200px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`"
                class="group relative overflow-hidden rounded-2xl p-px transition-transform duration-150 ease-out will-change-transform">
                <div class="pointer-events-none absolute inset-[-1000%] opacity-0 transition-opacity duration-500 [animation:spin_3.5s_linear_infinite] group-hover:opacity-100 [background:conic-gradient(from_0deg,transparent_0%,#2fb578_8%,transparent_18%)]"></div>
                <div class="relative overflow-hidden rounded-[15px] border border-gray-200 bg-white p-4 shadow-theme-xs transition-shadow duration-200 group-hover:shadow-theme-md dark:border-gray-800 dark:bg-gray-900">
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100" :style="`background: radial-gradient(280px circle at ${mx} ${my}, rgba(47,181,120,0.16), transparent 70%)`"></div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-white/80">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M9 12h6"/><path d="M9 16h6"/><path d="M9 8h6"/></svg>
                    </div>
                    <div class="mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">Total Data</div>
                    <div class="mt-1 font-mono text-2xl font-bold text-gray-800 dark:text-white/90">{{ $total }}</div>
                </div>
            </div>
        </div>

        {{-- card: Menunggu Tinjauan --}}
        <div class="animate-fade-up [perspective:1200px]" style="animation-delay:90ms">
            <div
                x-data="{ mx:'50%', my:'50%', rx:0, ry:0,
                    move(e){
                        const r = $el.getBoundingClientRect();
                        const px = (e.clientX - r.left) / r.width, py = (e.clientY - r.top) / r.height;
                        this.mx = (px * 100) + '%'; this.my = (py * 100) + '%';
                        this.rx = (py - 0.5) * -8; this.ry = (px - 0.5) * 8;
                    },
                    reset(){ this.rx = 0; this.ry = 0; }
                }"
                @mousemove="move($event)" @mouseleave="reset()"
                :style="`transform: perspective(1200px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`"
                class="group relative overflow-hidden rounded-2xl p-px transition-transform duration-150 ease-out will-change-transform">
                <div class="pointer-events-none absolute inset-[-1000%] opacity-0 transition-opacity duration-500 [animation:spin_3.5s_linear_infinite] group-hover:opacity-100 [background:conic-gradient(from_0deg,transparent_0%,#fbbf24_8%,transparent_18%)]"></div>
                <div class="relative overflow-hidden rounded-[15px] border border-gray-200 bg-white p-4 shadow-theme-xs transition-shadow duration-200 group-hover:shadow-theme-md dark:border-gray-800 dark:bg-gray-900">
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100" :style="`background: radial-gradient(280px circle at ${mx} ${my}, rgba(251,191,36,0.16), transparent 70%)`"></div>
                    <div class="flex items-center justify-between">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-warning-50 text-warning-600 dark:bg-warning-500/15 dark:text-warning-400">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                        </div>
                        @if ($menunggu > 0)
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-warning-400 opacity-75"></span>
                                <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-warning-500"></span>
                            </span>
                        @endif
                    </div>
                    <div class="mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">Menunggu Tinjauan</div>
                    <div class="mt-1 font-mono text-2xl font-bold text-gray-800 dark:text-white/90">{{ $menunggu }}</div>
                </div>
            </div>
        </div>

        {{-- card: Tayang Publik --}}
        <div class="animate-fade-up [perspective:1200px]" style="animation-delay:120ms">
            <div
                x-data="{ mx:'50%', my:'50%', rx:0, ry:0,
                    move(e){
                        const r = $el.getBoundingClientRect();
                        const px = (e.clientX - r.left) / r.width, py = (e.clientY - r.top) / r.height;
                        this.mx = (px * 100) + '%'; this.my = (py * 100) + '%';
                        this.rx = (py - 0.5) * -8; this.ry = (px - 0.5) * 8;
                    },
                    reset(){ this.rx = 0; this.ry = 0; }
                }"
                @mousemove="move($event)" @mouseleave="reset()"
                :style="`transform: perspective(1200px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`"
                class="group relative overflow-hidden rounded-2xl p-px transition-transform duration-150 ease-out will-change-transform">
                <div class="pointer-events-none absolute inset-[-1000%] opacity-0 transition-opacity duration-500 [animation:spin_3.5s_linear_infinite] group-hover:opacity-100 [background:conic-gradient(from_0deg,transparent_0%,#22935a_8%,transparent_18%)]"></div>
                <div class="relative overflow-hidden rounded-[15px] border border-gray-200 bg-white p-4 shadow-theme-xs transition-shadow duration-200 group-hover:shadow-theme-md dark:border-gray-800 dark:bg-gray-900">
                    <div class="pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100" :style="`background: radial-gradient(280px circle at ${mx} ${my}, rgba(34,147,90,0.16), transparent 70%)`"></div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>
                    </div>
                    <div class="mt-4 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">Tayang Publik</div>
                    <div class="mt-1 font-mono text-2xl font-bold text-gray-800 dark:text-white/90">{{ $terbit }}</div>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="animate-fade-up mb-3.5 flex flex-wrap gap-2.5" style="animation-delay:90ms">
        @if (request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama data / wilayah…"
               class="h-10 min-w-50 flex-1 rounded-lg border border-gray-200 bg-white px-3 text-sm transition-colors focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
        <x-form.native-select name="status" onchange="this.form.submit()" class="w-48">
            <option value="">Semua status</option>
            <option value="terbit" @selected(request('status') === 'terbit')>Tayang</option>
            <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu tinjauan</option>
            <option value="ditolak" @selected(request('status') === 'ditolak')>Ditolak</option>
        </x-form.native-select>
        <x-form.native-select name="per_page" onchange="this.form.submit()" class="w-36">
            <option value="10" @selected($perPage === 10)>10 / halaman</option>
            <option value="25" @selected($perPage === 25)>25 / halaman</option>
            <option value="50" @selected($perPage === 50)>50 / halaman</option>
            <option value="100" @selected($perPage === 100)>100 / halaman</option>
        </x-form.native-select>
        <button class="rounded-lg border border-gray-200 px-4 text-sm font-medium text-gray-600 transition-colors duration-150 hover:bg-gray-50 active:scale-95 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/5">Cari</button>
    </form>

    <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:120ms">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50 dark:border-gray-800 dark:bg-white/[0.02]">
                        <th class="px-3.5 py-2.5 text-left text-[10.5px] font-bold uppercase tracking-wide text-gray-400">Nama Data</th>
                        <th class="px-3.5 py-2.5 text-left text-[10.5px] font-bold uppercase tracking-wide text-gray-400">Kategori</th>
                        <th class="px-3.5 py-2.5 text-left text-[10.5px] font-bold uppercase tracking-wide text-gray-400">Wilayah</th>
                        <th class="px-3.5 py-2.5 text-left text-[10.5px] font-bold uppercase tracking-wide text-gray-400">Diunggah</th>
                        <th class="px-3.5 py-2.5 text-left text-[10.5px] font-bold uppercase tracking-wide text-gray-400">Status</th>
                        <th class="px-3.5 py-2.5"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lokasi as $l)
                        <tr class="border-b border-gray-50 transition-colors last:border-0 hover:bg-gray-50 dark:border-gray-800/60 dark:hover:bg-white/[0.02]">
                            <td class="px-3.5 py-3">
                                <div class="font-semibold text-gray-700 dark:text-gray-200">{{ $l->nama }}</div>
                                <div class="font-mono text-[11px] text-gray-400">{{ $l->kode }}</div>
                            </td>
                            <td class="px-3.5 py-3">
                                <x-ui.badge variant="light" color="light">{{ str_replace('Data ', '', $l->kategoriLabel()) }}</x-ui.badge>
                            </td>
                            <td class="px-3.5 py-3 text-gray-600 dark:text-gray-300">{{ $l->wilayah }}</td>
                            <td class="px-3.5 py-3 font-mono text-xs text-gray-500 dark:text-gray-400">{{ $l->bulanLabel() }} 2026</td>
                            <td class="px-3.5 py-3">
                                @if ($l->status === 'terbit')
                                    <x-ui.badge variant="light" color="success">Tayang</x-ui.badge>
                                @elseif ($l->status === 'ditolak')
                                    <x-ui.badge variant="light" color="error">Ditolak</x-ui.badge>
                                @else
                                    <x-ui.badge variant="light" color="warning">Menunggu tinjauan</x-ui.badge>
                                @endif
                            </td>
                            <td class="px-3.5 py-3">
                                @if ($role === 'admin' && $l->status === 'menunggu')
                                    <div class="flex gap-1.5">
                                        <form method="POST" action="{{ route('workspace.approve', $l) }}">
                                            @csrf
                                            <button class="rounded-lg border border-success-300 px-2 py-1 text-xs font-semibold text-success-600 transition-all duration-150 hover:bg-success-50 active:scale-95 dark:border-success-500/30 dark:text-success-400 dark:hover:bg-success-500/10">Setujui</button>
                                        </form>
                                        <form method="POST" action="{{ route('workspace.reject', $l) }}">
                                            @csrf
                                            <button class="rounded-lg border border-error-300 px-2 py-1 text-xs font-semibold text-error-600 transition-all duration-150 hover:bg-error-50 active:scale-95 dark:border-error-500/30 dark:text-error-400 dark:hover:bg-error-500/10">Tolak</button>
                                        </form>
                                    </div>
                                @elseif ($l->status === 'ditolak')
                                    <span class="font-mono text-[11px] text-gray-400">tidak tayang</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="p-8 text-center text-sm text-gray-400">Tidak ada data yang cocok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($lokasi->hasPages())
            @php
                $current = $lokasi->currentPage();
                $last = $lokasi->lastPage();
                $pages = collect(range(1, $last))->filter(fn ($p) => $p === 1 || $p === $last || ($p >= $current - 1 && $p <= $current + 1))->values();
            @endphp
            <div class="flex flex-col items-center justify-between gap-3 border-t border-gray-100 px-4 py-3.5 dark:border-gray-800 sm:flex-row">
                <p class="text-xs text-gray-400 dark:text-gray-500">
                    Menampilkan <span class="font-semibold text-gray-600 dark:text-gray-300">{{ $lokasi->firstItem() }}–{{ $lokasi->lastItem() }}</span>
                    dari <span class="font-semibold text-gray-600 dark:text-gray-300">{{ $lokasi->total() }}</span> data
                </p>
                <div class="flex items-center gap-1">
                    <a href="{{ $lokasi->onFirstPage() ? '#' : $lokasi->previousPageUrl() }}"
                       class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-gray-500 transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white {{ $lokasi->onFirstPage() ? 'pointer-events-none opacity-40' : '' }}"
                       aria-label="Sebelumnya">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M10 3 5 8l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>

                    @php $prevPage = null; @endphp
                    @foreach ($pages as $page)
                        @if ($prevPage !== null && $page - $prevPage > 1)
                            <span class="flex h-9 w-9 items-center justify-center text-xs text-gray-400">…</span>
                        @endif
                        <a href="{{ $lokasi->url($page) }}"
                           class="flex h-9 w-9 items-center justify-center rounded-lg text-xs font-semibold transition-colors {{ $page === $current ? 'bg-brand-500 text-white' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5' }}">
                            {{ $page }}
                        </a>
                        @php $prevPage = $page; @endphp
                    @endforeach

                    <a href="{{ $lokasi->hasMorePages() ? $lokasi->nextPageUrl() : '#' }}"
                       class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 text-gray-500 transition-colors hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white {{ ! $lokasi->hasMorePages() ? 'pointer-events-none opacity-40' : '' }}"
                       aria-label="Selanjutnya">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M6 3l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <p class="mt-4 text-xs leading-relaxed text-gray-400 dark:text-gray-500">
        Alur persetujuan ini masih asumsi kerja (Bagian 7) — tombol Setujui/Tolak di atas mensimulasikan bagaimana data Operator berubah status sebelum tayang di Dashboard/Beranda publik.
    </p>

    <x-ui.drawer :is-open="$errors->any()" x-on:open-drawer.window="open = true">
        <div class="border-b border-gray-100 p-6 dark:border-gray-800">
            <div class="mb-1.5 flex items-center gap-1.5 text-xs font-bold uppercase tracking-wide text-brand-500">FORM PENGISIAN DATA</div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white/90">Tambah Data Baru</h2>
            <p class="mt-1 max-w-[38ch] text-xs text-gray-500 dark:text-gray-400">
                Satu halaman, tanpa langkah bertahap. Tersimpan sebagai <b>menunggu tinjauan Admin</b> (asumsi kerja, Bagian 6.2 &amp; 7).
            </p>
        </div>

        <form method="POST" action="{{ route('workspace.store') }}" enctype="multipart/form-data" class="flex flex-1 flex-col gap-5 p-6">
            @csrf

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Kategori Data <span class="text-error-500">*</span></label>
                <x-form.native-select name="kategori" :invalid="$errors->has('kategori')">
                    <option value="">— Pilih kategori —</option>
                    <option value="hutan" @selected(old('kategori') === 'hutan')>Data Kehutanan</option>
                    <option value="program" @selected(old('kategori') === 'program')>Data Program</option>
                    <option value="monitoring" @selected(old('kategori') === 'monitoring')>Data Monitoring</option>
                </x-form.native-select>
                @error('kategori') <p class="mt-1.5 text-xs font-semibold text-error-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Data <span class="text-error-500">*</span></label>
                <input name="nama" maxlength="150" value="{{ old('nama') }}" placeholder="mis. Batas Areal Restorasi Blok Sitinjau, Kab. Solok"
                       class="h-11 w-full rounded-lg border {{ $errors->has('nama') ? 'border-error-400' : 'border-gray-300 dark:border-gray-700' }} bg-transparent px-4 text-sm text-gray-800 transition-colors focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:bg-gray-900 dark:text-white/90">
                @error('nama') <p class="mt-1.5 text-xs font-semibold text-error-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Unggah Data IG (.zip berisi shapefile) <span class="text-error-500">*</span></label>
                <div class="cursor-pointer rounded-xl border-2 border-dashed {{ $errors->has('ig_zip') ? 'border-error-400' : 'border-gray-300 dark:border-gray-700' }} bg-gray-50 p-5 text-center transition-colors duration-150 hover:border-brand-300 hover:bg-brand-50/40 dark:bg-gray-900 dark:hover:bg-brand-500/5"
                     onclick="document.getElementById('ig_zip').click()">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Klik untuk pilih file .zip</p>
                    <p class="mt-1 text-xs text-gray-400">Maks. 25 MB · harus berisi .shp/.dbf/.shx/.prj</p>
                </div>
                <input id="ig_zip" type="file" name="ig_zip" accept=".zip" class="hidden"
                       onchange="document.getElementById('ig_zip_name').textContent = this.files[0] ? this.files[0].name : ''">
                <p id="ig_zip_name" class="animate-fade-up mt-1.5 truncate font-mono text-xs text-gray-500"></p>
                <p class="mt-1.5 text-xs text-gray-400">Format &amp; ukuran maksimum final menunggu konfirmasi tim teknis (lihat Bagian 7).</p>
                @error('ig_zip') <p class="mt-1.5 text-xs font-semibold text-error-500">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Unggah Style Data <span class="text-[11px] uppercase tracking-wide text-gray-400">Opsional</span></label>
                <div class="cursor-pointer rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 p-4 text-center transition-colors duration-150 hover:border-brand-300 hover:bg-brand-50/40 dark:border-gray-700 dark:bg-gray-900 dark:hover:bg-brand-500/5"
                     onclick="document.getElementById('style_file').click()">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Klik untuk pilih file .qml / .sld</p>
                    <p class="mt-1 text-xs text-gray-400">Mengatur tampilan visual data di peta Dashboard</p>
                </div>
                <input id="style_file" type="file" name="style_file" accept=".qml,.sld" class="hidden"
                       onchange="document.getElementById('style_file_name').textContent = this.files[0] ? this.files[0].name : ''">
                <p id="style_file_name" class="animate-fade-up mt-1.5 truncate font-mono text-xs text-gray-500"></p>
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Sumber Data <span class="text-[11px] uppercase tracking-wide text-gray-400">Opsional</span></label>
                <input name="sumber" value="{{ old('sumber') }}" placeholder="mis. Survei lapangan Tim WARSI, Agustus 2026"
                       class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 transition-colors focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi <span class="text-[11px] uppercase tracking-wide text-gray-400">Opsional</span></label>
                <textarea name="deskripsi" maxlength="1000" rows="4" placeholder="Konteks singkat data ini…"
                          class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 transition-colors focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="mt-1 flex justify-end gap-2.5 border-t border-gray-100 pt-5 dark:border-gray-800">
                <button type="reset" class="rounded-lg bg-white px-4 py-2.5 text-sm font-medium text-gray-700 ring-1 ring-inset ring-gray-300 transition-all duration-150 hover:bg-gray-50 active:scale-[0.97] dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700">Bersihkan</button>
                <button type="submit" class="rounded-lg bg-linear-to-b from-brand-400 to-brand-600 px-4 py-2.5 text-sm font-medium text-white shadow-theme-xs transition-all duration-150 hover:from-brand-500 hover:to-brand-700 hover:shadow-lg hover:shadow-brand-500/25 active:scale-[0.97]">Simpan Data</button>
            </div>
        </form>
    </x-ui.drawer>
@endsection
