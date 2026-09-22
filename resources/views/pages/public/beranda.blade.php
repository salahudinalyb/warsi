@extends('layouts.public')

@php
    $items = $publikasi->map(fn($p) => [
        'tipe' => $p->tipe,
        'label' => $p->label,
        'judul' => $p->judul,
        'wilayah' => $p->wilayah,
        'tanggal' => $p->tanggal->locale('id')->isoFormat('D MMM Y'),
        'ringkasan' => $p->ringkasan,
    ]);
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-gray-200 bg-linear-to-br from-gray-50 to-brand-50 dark:border-gray-800 dark:from-gray-900 dark:to-gray-800">
        <div class="relative z-10 mx-auto grid max-w-(--breakpoint-2xl) gap-10 px-4 pb-14 pt-14 md:grid-cols-[1fr_1fr] md:items-center md:px-6 md:pb-20 md:pt-16">
            <div>
                <div class="animate-fade-up mb-4 flex items-center gap-2 text-xs font-bold uppercase tracking-[0.14em] text-brand-500">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-500"></span>
                    Sistem Data &amp; Pengetahuan Program
                </div>
                <h1 class="animate-fade-up max-w-[22ch] text-title-md font-extrabold leading-[1.08] tracking-tight text-gray-800 dark:text-white/90 md:text-title-lg" style="animation-delay:80ms">
                    Sistem Database dan Pengelolaan Pengetahuan <span class="text-brand-500">Program RBP REDD+ GCF Output 2</span> Provinsi Sumatera Barat
                </h1>
                <p class="animate-fade-up mt-5 max-w-[46ch] text-[15.5px] leading-relaxed text-gray-500 dark:text-gray-400" style="animation-delay:160ms">
                    Mengonsolidasikan data kehutanan, program, dan monitoring KKI WARSI yang sebelumnya tersebar — supaya tim, mitra, dan publik melihat capaian yang sama.
                </p>
                <div class="animate-fade-up mt-7 flex flex-wrap gap-3" style="animation-delay:240ms">
                    <a href="{{ route('dashboard') }}" class="group inline-flex items-center gap-2 rounded-lg bg-linear-to-b from-brand-400 to-brand-600 px-5 py-3 text-sm font-medium text-white shadow-theme-xs transition-all duration-200 hover:from-brand-500 hover:to-brand-700 hover:shadow-lg hover:shadow-brand-500/25 active:scale-[0.97]">
                        Lihat Dashboard Capaian
                        <svg class="transition-transform duration-200 group-hover:translate-x-0.5" width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M4 8h8M8 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="#publikasi" class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-3 text-sm font-medium text-gray-700 ring-1 ring-inset ring-gray-300 transition-all duration-200 hover:bg-gray-50 active:scale-[0.97] dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700 dark:hover:bg-white/5">
                        Jelajahi Publikasi
                    </a>
                </div>
            </div>

            {{-- field ledger: real stats as the hero visual, not decoration --}}
            <div class="animate-fade-up relative mx-auto w-full max-w-md md:ml-auto" style="animation-delay:340ms">
                <div class="-rotate-1 rounded-2xl border border-gray-200 bg-white p-7 shadow-theme-lg transition-transform duration-300 ease-out hover:rotate-0 dark:border-gray-800 dark:bg-gray-900">
                    <div class="mb-6 flex items-center justify-between border-b border-dashed border-gray-200 pb-4 dark:border-gray-700">
                        <span class="text-[10px] font-bold uppercase tracking-[0.14em] text-gray-400">Ringkasan Capaian</span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-success-50 px-2.5 py-1 text-[10px] font-bold text-success-600 dark:bg-success-500/15 dark:text-success-400">
                            <span class="relative flex h-1.5 w-1.5">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-success-400 opacity-75"></span>
                                <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-success-500"></span>
                            </span>
                            LIVE · 2026
                        </span>
                    </div>
                    <div class="space-y-5">
                        <div data-reveal class="flex items-start gap-3.5">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.5-7-11a7 7 0 1 1 14 0c0 4.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-baseline gap-1.5">
                                    <span class="font-mono text-2xl font-bold tabular-nums text-gray-800 dark:text-white/90"><span data-count-to="{{ $totalLuas }}">0</span></span>
                                    <span class="text-sm text-gray-400">ha</span>
                                </div>
                                <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Luas kawasan termonitor</div>
                                <div class="mt-2 h-1 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                    <div class="h-full w-4/5 origin-left scale-x-0 rounded-full bg-brand-500 transition-transform duration-700 [.is-visible_&]:scale-x-100"></div>
                                </div>
                            </div>
                        </div>
                        <div data-reveal style="transition-delay:100ms" class="flex items-start gap-3.5">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 10 13.5 10 13.5"/></svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-baseline gap-1.5">
                                    <span class="font-mono text-2xl font-bold tabular-nums text-gray-800 dark:text-white/90"><span data-count-to="214900">0</span></span>
                                    <span class="text-sm text-gray-400">tCO₂e</span>
                                </div>
                                <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Estimasi emisi tereduksi</div>
                                <div class="mt-2 h-1 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                    <div class="h-full w-full origin-left scale-x-0 rounded-full bg-brand-500 transition-transform duration-700 [.is-visible_&]:scale-x-100"></div>
                                </div>
                            </div>
                        </div>
                        <div data-reveal style="transition-delay:200ms" class="flex items-start gap-3.5">
                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/></svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-baseline gap-1.5">
                                    <span class="font-mono text-2xl font-bold tabular-nums text-gray-800 dark:text-white/90"><span data-count-to="18">0</span></span>
                                </div>
                                <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Kabupaten/kota terjangkau</div>
                                <div class="mt-2 h-1 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                                    <div class="h-full w-3/5 origin-left scale-x-0 rounded-full bg-brand-500 transition-transform duration-700 [.is-visible_&]:scale-x-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- distribusi kategori: segmented bar, real proportion --}}
                    @php
                        $kTotal = max(1, array_sum($kategoriCounts));
                        $kColor = ['hutan' => '#318454', 'program' => '#A06024', 'monitoring' => '#3077AD'];
                        $kLabel = ['hutan' => 'Kehutanan', 'program' => 'Program', 'monitoring' => 'Monitoring'];
                    @endphp
                    <div data-reveal style="transition-delay:300ms" class="mt-6 border-t border-dashed border-gray-200 pt-5 dark:border-gray-700">
                        <div class="mb-2.5 text-[10px] font-bold uppercase tracking-[0.14em] text-gray-400">Distribusi Kategori Tayang</div>
                        <div class="flex h-2.5 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800">
                            @foreach ($kategoriCounts as $key => $count)
                                <div class="h-full origin-left scale-x-0 transition-transform duration-700 [.is-visible_&]:scale-x-100"
                                     style="width:{{ $count / $kTotal * 100 }}%; background:{{ $kColor[$key] }}; transition-delay:{{ 350 + $loop->index * 80 }}ms"></div>
                            @endforeach
                        </div>
                        <div class="mt-3 flex flex-wrap gap-3.5 text-[11px] text-gray-500 dark:text-gray-400">
                            @foreach ($kategoriCounts as $key => $count)
                                <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full" style="background:{{ $kColor[$key] }}"></span>{{ $kLabel[$key] }} <b class="text-gray-700 dark:text-gray-200">{{ $count }}</b></span>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('dashboard') }}" class="group mt-6 flex items-center justify-between rounded-lg bg-gray-50 px-4 py-3 text-xs font-semibold text-gray-600 transition-colors hover:bg-brand-50 hover:text-brand-600 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-brand-500/10 dark:hover:text-brand-400">
                        Lihat rincian lengkap di Dashboard
                        <svg class="transition-transform duration-200 group-hover:translate-x-0.5" width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M4 8h8M8 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
                <div class="absolute -bottom-3 -right-3 -z-10 h-full w-full rounded-2xl border border-gray-200 bg-white/60 dark:border-gray-800 dark:bg-gray-900/40"></div>
            </div>
        </div>

        {{-- contour section divider --}}
        <svg viewBox="0 0 1440 40" preserveAspectRatio="none" class="relative z-10 block h-8 w-full text-gray-300 dark:text-gray-800">
            <path pathLength="1" d="M0,22 C120,4 240,36 360,20 C480,4 600,36 720,20 C840,4 960,36 1080,20 C1200,4 1320,36 1440,20"
                  stroke="currentColor" stroke-width="1" fill="none" class="animate-draw-line-n" style="animation-delay:700ms"/>
        </svg>
    </section>

    {{-- shared clip-path for every folder card's tab — real SVG arcs give the notch true rounded corners --}}
    <svg width="0" height="0" class="absolute" aria-hidden="true">
        <defs>
            <clipPath id="folderTabClip" clipPathUnits="objectBoundingBox">
                <path d="M0,0 L1,0 L1,0.552 L0.67,0.552 Q0.64,0.552 0.62,0.536 L0.50,0.472 Q0.48,0.456 0.45,0.456 L0,0.456 Z"/>
            </clipPath>
        </defs>
    </svg>

    {{-- Publikasi --}}
    <div id="publikasi" class="mx-auto max-w-(--breakpoint-2xl) px-4 py-14 md:px-6"
         x-data="{
            query: '',
            tipe: 'all',
            items: {{ $items->values()->toJson() }},
            get filtered() {
                return this.items.filter(k => {
                    const okTipe = this.tipe === 'all' || k.tipe === this.tipe;
                    const q = this.query.trim().toLowerCase();
                    const okQ = !q || (k.judul + ' ' + k.wilayah + ' ' + k.ringkasan).toLowerCase().includes(q);
                    return okTipe && okQ;
                });
            }
         }">
        <div class="mb-6 flex flex-wrap items-baseline justify-between gap-4">
            <div data-reveal>
                <h2 class="text-title-sm font-bold text-gray-800 dark:text-white/90">Publikasi &amp; Pengetahuan Program</h2>
                <div class="mt-1.5 text-sm text-gray-500 dark:text-gray-400">Praktik baik, cerita perubahan, dan produk pembelajaran dari lapangan.</div>
            </div>
            <div class="flex w-full max-w-sm items-center gap-2 rounded-full border border-gray-200 bg-white py-2 pl-4 pr-2 shadow-theme-xs transition-all duration-200 focus-within:border-brand-300 focus-within:shadow-theme-md focus-within:ring-3 focus-within:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900">
                <svg class="text-gray-400" width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="9" r="6"/><path d="M17 17l-3.5-3.5" stroke-linecap="round"/></svg>
                <input type="search" x-model="query" placeholder="Cari judul, lokasi, topik…" class="min-w-0 flex-1 border-none bg-transparent text-sm text-gray-700 outline-none placeholder:text-gray-400 dark:text-gray-300">
            </div>
        </div>

        <div class="mb-8 flex flex-wrap gap-2">
            <button @click="tipe = 'all'" :class="tipe === 'all' ? 'bg-brand-500 text-white border-brand-500' : 'text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400'" class="rounded-full border px-3.5 py-1.5 text-xs font-semibold transition-all duration-200 hover:-translate-y-0.5 active:scale-95">Semua</button>
            @foreach ($tipeList as $key => $label)
                <button @click="tipe = '{{ $key }}'" :class="tipe === '{{ $key }}' ? 'bg-brand-500 text-white border-brand-500' : 'text-gray-500 border-gray-200 dark:border-gray-700 dark:text-gray-400'" class="rounded-full border px-3.5 py-1.5 text-xs font-semibold transition-all duration-200 hover:-translate-y-0.5 active:scale-95">{{ $label }}</button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <template x-for="(k, i) in filtered" :key="k.judul">
                <article
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-3"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    :style="`transition-delay:${Math.min(i, 6) * 40}ms`"
                    class="group [container-type:inline-size] transition-transform duration-300 ease-out hover:-translate-y-2">
                    {{-- folder bezel --}}
                    <div class="relative box-border aspect-[544/522] w-full rounded-[8.46cqw] border border-gray-200 bg-gray-50 p-[2.57cqw] shadow-theme-xs transition-shadow duration-300 group-hover:shadow-theme-lg dark:border-gray-800 dark:bg-gray-900">
                        <div class="relative h-full w-full overflow-hidden rounded-[5.88cqw] bg-gray-50 dark:bg-gray-900">
                            {{-- title + meta sit on the plain panel; the tab shape above them is what morphs --}}
                            <div class="absolute left-[4.78cqw] top-[51cqw] right-[4.78cqw] leading-none">
                                <h3 class="m-0 text-[clamp(15px,4.4cqw,18px)] font-bold leading-snug tracking-[0.005em] text-gray-800 dark:text-white/90" x-text="k.judul"></h3>
                                <p class="mt-[2.15cqw] line-clamp-2 text-[clamp(12.5px,3.6cqw,14.5px)] leading-relaxed tracking-[0.005em] text-gray-500 dark:text-gray-400" x-text="k.ringkasan"></p>
                            </div>
                            <div class="absolute inset-x-[4.78cqw] bottom-[4.3cqw] flex translate-y-1 items-baseline justify-between gap-2 leading-none opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                <span class="flex items-center gap-[1cqw] text-[clamp(12.5px,3.6cqw,14.5px)] font-bold text-gray-800 dark:text-white/90">
                                    <svg class="h-[3.4cqw] w-[3.4cqw] shrink-0 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.5-7-11a7 7 0 1 1 14 0c0 4.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                                    <span x-text="k.wilayah"></span>
                                </span>
                                <span class="shrink-0 text-[clamp(11.5px,3.6cqw,13.5px)] font-bold text-gray-700 dark:text-gray-300" x-text="k.tanggal"></span>
                            </div>

                            {{-- the tab: clipped with a real SVG path (true rounded corners), scales down from the top on hover --}}
                            <div class="absolute inset-x-0 -top-[25%] h-[125%] transition-transform duration-500 [clip-path:url(#folderTabClip)] group-hover:-translate-y-[8%]">
                                <div class="folder-gradient absolute inset-0"></div>
                                <div class="folder-gradient-bright absolute inset-0 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
                            </div>

                            {{-- badge, always on top, fixed top-right --}}
                            <span class="absolute right-[4.78cqw] top-[6cqw] rounded-full border border-white/25 bg-black/20 px-[3cqw] py-[1.3cqw] text-[3cqw] font-semibold uppercase tracking-wide text-white backdrop-blur-sm" x-text="k.label"></span>
                        </div>
                    </div>
                </article>
            </template>
        </div>
        <p x-show="filtered.length === 0" x-cloak
           x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
           class="rounded-lg border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
            Tidak ada publikasi yang cocok. Coba ubah kata kunci atau kategori.
        </p>
    </div>
@endsection

@section('footer')
    @include('components.public.footer')
@endsection
