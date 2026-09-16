@extends('layouts.public')

@php
    use App\Models\Lokasi;

    // Approximate regency-seat coordinates — real geography, not survey-precise
    // (exact points arrive later via the .shp files Operators upload).
    $wilayahCoords = [
        'Kab. Solok' => [-0.796, 100.653],
        'Kab. Lima Puluh Kota' => [0.100, 100.650],
        'Kab. Dharmasraya' => [-1.283, 101.567],
        'Kab. Solok Selatan' => [-1.433, 101.467],
        'Kab. Pasaman' => [0.317, 99.967],
        'Kab. Padang Pariaman' => [-0.583, 100.167],
        'Kab. Kep. Mentawai' => [-1.900, 99.300],
        'Kab. Pesisir Selatan' => [-1.350, 100.567],
        'Kab. Agam' => [-0.283, 100.100],
        'Kab. Sijunjung' => [-0.700, 100.983],
        'Kab. Tanah Datar' => [-0.450, 100.567],
        'Kab. Pasaman Barat' => [0.150, 99.633],
        'Kota Bukittinggi' => [-0.305, 100.369],
        'Kota Payakumbuh' => [-0.224, 100.633],
        'Kota Padang' => [-0.950, 100.354],
        'Kota Padang Panjang' => [-0.453, 100.400],
        'Kota Pariaman' => [-0.626, 100.117],
        'Kota Sawahlunto' => [-0.683, 100.783],
    ];

    $rows = $lokasi->map(function ($l) use ($wilayahCoords) {
        [$lat, $lng] = $wilayahCoords[$l->wilayah] ?? [-0.9, 100.6];

        return [
            'id' => $l->kode,
            'nama' => $l->nama,
            'wilayah' => $l->wilayah,
            'kategori' => $l->kategori,
            'bulan' => $l->bulan,
            'luas' => $l->luas,
            'penerima' => $l->penerima,
            'lat' => $lat,
            'lng' => $lng,
        ];
    });
    $kategoriLabel = Lokasi::KATEGORI_LABEL;
    $bulanLabel = Lokasi::BULAN_LABEL;
@endphp

@section('content')
    <div
         x-data="{
            rows: {{ $rows->values()->toJson() }},
            kategoriLabel: {{ Illuminate\Support\Js::from($kategoriLabel) }},
            bulanLabel: {{ Illuminate\Support\Js::from($bulanLabel) }},
            activeCats: { hutan: true, program: true, monitoring: true },
            wilayah: 'all',
            periode: 'all',
            sort: 'terbaru',
            search: '',
            mapAsTable: false,
            periodeRange(p) {
                if (p === 'q1') return [1, 3];
                if (p === 'q2') return [4, 6];
                if (p === 'q3') return [7, 9];
                return [1, 12];
            },
            get filtered() {
                const range = this.periodeRange(this.periode);
                const q = this.search.trim().toLowerCase();
                let out = this.rows.filter(l => {
                    if (!this.activeCats[l.kategori]) return false;
                    if (this.wilayah !== 'all' && l.wilayah !== this.wilayah) return false;
                    if (l.bulan < range[0] || l.bulan > range[1]) return false;
                    if (q && !(l.nama + ' ' + l.wilayah).toLowerCase().includes(q)) return false;
                    return true;
                });
                if (this.sort === 'nama') out.sort((a, b) => a.nama.localeCompare(b.nama));
                else if (this.sort === 'luas') out.sort((a, b) => b.luas - a.luas);
                else out.sort((a, b) => b.bulan - a.bulan);
                return out;
            },
            get totalLuas() { return this.filtered.reduce((s, l) => s + l.luas, 0); },
            get totalPenerima() { return this.filtered.reduce((s, l) => s + l.penerima, 0); },
            countByKategori(k) { return this.filtered.filter(l => l.kategori === k).length; },
            get barMax() { return Math.max(1, this.countByKategori('hutan'), this.countByKategori('program'), this.countByKategori('monitoring')); },
            get regions() {
                const counts = {};
                this.filtered.forEach(l => counts[l.wilayah] = (counts[l.wilayah] || 0) + 1);
                return Object.entries(counts).sort((a, b) => b[1] - a[1]).slice(0, 6);
            },
            resetFilters() {
                this.activeCats = { hutan: true, program: true, monitoring: true };
                this.wilayah = 'all'; this.periode = 'all'; this.sort = 'terbaru'; this.search = '';
            },
            init() {
                this.$watch('filtered', (rows) => {
                    if (window.updateMapSebaranMarkers) window.updateMapSebaranMarkers(rows);
                    if (window.updateChartKategoriData) {
                        const counts = ['hutan', 'program', 'monitoring'].map(k => rows.filter(l => l.kategori === k).length);
                        window.updateChartKategoriData(counts);
                    }
                    if (window.updateChartWilayahData) {
                        const shortName = (w) => w.replace(/^(Kab\.|Kota)\s+/, '');
                        window.updateChartWilayahData(this.regions.map(r => shortName(r[0])), this.regions.map(r => r[1]));
                    }
                });
            }
         }">
    <div class="relative overflow-hidden border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-brand-200/30 blur-3xl dark:bg-brand-500/10"></div>
        <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-linear-to-r from-transparent via-brand-400/70 to-transparent"></div>

        <div class="relative mx-auto max-w-(--breakpoint-2xl) px-4 pb-6 pt-7 md:px-6">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-title-sm font-extrabold tracking-tight text-gray-800 dark:text-white/90">Dashboard Capaian Program</h1>
                    <p class="mt-1.5 max-w-[60ch] text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                        Visualisasi capaian RBP REDD+ GCF Output 2 — monitoring, evaluasi, dan sebaran kegiatan di Provinsi Sumatera Barat.
                    </p>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-gray-50 px-3.5 py-2 dark:border-gray-700 dark:bg-white/5">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-brand-500"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Data per <b class="font-semibold text-gray-700 dark:text-gray-200">15 Sep 2026</b></span>
                </div>
            </div>

            {{-- filter toolbar --}}
            <div class="relative z-10 mt-6 flex flex-wrap items-end gap-x-5 gap-y-4 rounded-2xl border border-gray-200 bg-gray-50/70 p-4 shadow-theme-xs dark:border-gray-800 dark:bg-white/[0.02]">
                <div class="flex flex-col gap-1.5">
                    <span class="flex items-center gap-1 text-[10.5px] font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h10M4 18h6"/></svg>
                        Kategori
                    </span>
                    <div class="flex gap-1.5">
                        @php $kDot = ['hutan' => '#318454', 'program' => '#A06024', 'monitoring' => '#3077AD']; @endphp
                        @foreach ($kategoriLabel as $key => $label)
                            <button @click="activeCats.{{ $key }} = !activeCats.{{ $key }}"
                                    :class="activeCats.{{ $key }} ? 'bg-brand-500 text-white border-brand-500' : 'bg-white text-gray-500 border-gray-200 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-400'"
                                    class="flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-semibold transition-all duration-200 active:scale-95">
                                <span class="h-1.5 w-1.5 rounded-full" style="background:{{ $kDot[$key] }}"></span>
                                {{ str_replace('Data ', '', $label) }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="h-9 w-px bg-gray-200 dark:bg-gray-700"></div>

                <div class="flex flex-col gap-1.5">
                    <span class="flex items-center gap-1 text-[10.5px] font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.5-7-11a7 7 0 1 1 14 0c0 4.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        Wilayah
                    </span>
                    <x-form.native-select x-model="wilayah" class="w-56">
                        <option value="all">Semua kabupaten/kota</option>
                        @foreach ($wilayahList as $w)
                            <option value="{{ $w }}">{{ $w }}</option>
                        @endforeach
                    </x-form.native-select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <span class="flex items-center gap-1 text-[10.5px] font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        Periode
                    </span>
                    <x-form.native-select x-model="periode" class="w-40">
                        <option value="all">Sepanjang 2026</option>
                        <option value="q1">Jan–Mar 2026</option>
                        <option value="q2">Apr–Jun 2026</option>
                        <option value="q3">Jul–Sep 2026</option>
                    </x-form.native-select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <span class="flex items-center gap-1 text-[10.5px] font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h11M3 12h7M3 17h4M17 4v16M17 4l3 3M17 4l-3 3"/></svg>
                        Urutkan
                    </span>
                    <x-form.native-select x-model="sort" class="w-36">
                        <option value="terbaru">Terbaru</option>
                        <option value="nama">Nama A–Z</option>
                        <option value="luas">Luas terbesar</option>
                    </x-form.native-select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <span class="text-[10.5px] font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">Cari lokasi</span>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400" width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="9" r="6"/><path d="M17 17l-3.5-3.5" stroke-linecap="round"/></svg>
                        <input type="search" x-model="search" placeholder="nama titik / desa…" class="h-9 rounded-lg border border-gray-200 bg-white pl-8 pr-2.5 text-sm text-gray-700 outline-none transition-colors focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                    </div>
                </div>

                <button @click="resetFilters()" class="ml-auto text-xs font-semibold text-brand-500 transition-colors hover:underline active:scale-95">Reset filter</button>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-(--breakpoint-2xl) px-4 pt-5 md:px-6">

        <div class="mb-6 grid grid-cols-2 gap-3.5 sm:grid-cols-3 lg:grid-cols-6">
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:0ms">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-white/80">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-6.5-7-11a7 7 0 1 1 14 0c0 4.5-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>
                </div>
                <div class="mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500">Titik Kegiatan</div>
                <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90" x-text="filtered.length"></div>
                <div class="mt-1 text-[11px] font-semibold text-gray-400 dark:text-gray-500">sesuai filter aktif</div>
            </div>
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:50ms">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-white/80">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/></svg>
                </div>
                <div class="mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500">Luas Termonitor</div>
                <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90"><span x-text="totalLuas.toLocaleString('id-ID')"></span> <span class="text-xs font-semibold text-gray-400">ha</span></div>
                <div class="mt-1 text-[11px] font-semibold text-gray-400 dark:text-gray-500">sesuai filter aktif</div>
            </div>
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:100ms">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-white/80">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500">Penerima Manfaat</div>
                <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90"><span x-text="totalPenerima.toLocaleString('id-ID')"></span> <span class="text-xs font-semibold text-gray-400">orang</span></div>
                <div class="mt-1 text-[11px] font-semibold text-gray-400 dark:text-gray-500">sesuai filter aktif</div>
            </div>
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:150ms">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-white/80">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <div class="mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500">Produk Pengetahuan</div>
                <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">{{ $publikasiCount }} <span class="text-xs font-semibold text-gray-400">dokumen</span></div>
                <div class="mt-1 text-[11px] font-semibold text-gray-400 dark:text-gray-500">seluruh Beranda</div>
            </div>
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:200ms">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-white/80">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/></svg>
                </div>
                <div class="mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500">Statistik Publikasi</div>
                <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">{{ $tipeAktif }}/7 <span class="text-xs font-semibold text-gray-400">kategori</span></div>
                <div class="mt-1 text-[11px] font-semibold text-gray-400 dark:text-gray-500">dari 7 jenis konten</div>
            </div>
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:250ms">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-50 text-brand-600 dark:bg-brand-500/15 dark:text-brand-400">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 10 13.5 10 13.5"/></svg>
                </div>
                <div class="mt-4 text-xs font-semibold text-gray-400 dark:text-gray-500">Emisi Tereduksi</div>
                <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white/90">214.900 <span class="text-xs font-semibold text-gray-400">tCO₂e</span></div>
                <div class="mt-1 text-[11px] font-semibold text-gray-400 dark:text-gray-500">kumulatif s.d. Ags</div>
            </div>
        </div>

        <div class="mb-5 grid gap-4 lg:grid-cols-[1.5fr_1fr]">
            <div class="animate-fade-up flex flex-col rounded-2xl border border-gray-200 bg-white p-5 transition-shadow duration-200 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:300ms">
                <div class="mb-1 flex items-center justify-between gap-2">
                    <h3 class="text-sm font-bold text-gray-800 dark:text-white/90">Sebaran Lokasi Kegiatan <span class="text-xs font-normal text-gray-400">(skematik)</span></h3>
                    <button @click="mapAsTable = !mapAsTable" class="text-xs font-semibold text-brand-500 transition-colors hover:underline" x-text="mapAsTable ? 'Lihat sebagai peta' : 'Lihat sebagai tabel'"></button>
                </div>

                <div x-show="!mapAsTable" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="flex flex-1 flex-col">
                <div class="relative mt-3 min-h-95 flex-1">
                    <div id="mapSebaran"
                         class="h-full overflow-hidden rounded-lg"
                         data-all="{{ $rows->values()->toJson() }}"
                         data-colors="{{ json_encode(['hutan' => '#318454', 'program' => '#A06024', 'monitoring' => '#3077AD']) }}"></div>

                    <div class="absolute right-3 top-3 z-10 flex flex-col items-end gap-2">
                        <button type="button" id="mapSebaranReset" aria-label="Reset peta ke posisi awal" title="Reset peta ke posisi awal"
                                onclick="window.resetMapSebaran && window.resetMapSebaran()"
                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 opacity-0 pointer-events-none shadow-theme-xs transition-opacity duration-200 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="8" cy="8" r="3" stroke="currentColor" stroke-width="1.5"/>
                                <circle cx="8" cy="8" r="1" fill="currentColor"/>
                                <path d="M8 1v2M8 13v2M1 8h2M13 8h2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </button>

                        <div class="flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
                            <button type="button" id="mapSebaranZoomIn" aria-label="Perbesar"
                                    class="flex h-9 w-9 items-center justify-center border-b border-gray-200 text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 3.33334V12.6667M3.33334 8H12.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button type="button" id="mapSebaranZoomOut" aria-label="Perkecil"
                                    class="flex h-9 w-9 items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.33334 8H12.6667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="mt-2 flex flex-wrap items-center gap-4 text-xs text-gray-400 dark:text-gray-500">
                    @php $kategoriColor = ['hutan' => '#318454', 'program' => '#A06024', 'monitoring' => '#3077AD']; @endphp
                    @foreach ($kategoriLabel as $key => $label)
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full" style="background:{{ $kategoriColor[$key] }}"></span>{{ $label }}</span>
                    @endforeach
                </div>
                </div>

                <div x-show="mapAsTable" x-cloak
                     x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-2.5 py-1.5 text-left text-[10.5px] font-bold uppercase text-gray-400">ID</th>
                                <th class="px-2.5 py-1.5 text-left text-[10.5px] font-bold uppercase text-gray-400">Nama Lokasi</th>
                                <th class="px-2.5 py-1.5 text-left text-[10.5px] font-bold uppercase text-gray-400">Wilayah</th>
                                <th class="px-2.5 py-1.5 text-left text-[10.5px] font-bold uppercase text-gray-400">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="l in filtered" :key="l.id">
                                <tr class="border-b border-gray-50 transition-colors hover:bg-gray-50 dark:border-gray-800/60 dark:hover:bg-white/[0.02]">
                                    <td class="px-2.5 py-1.5 font-mono text-xs text-gray-500 dark:text-gray-400" x-text="l.id"></td>
                                    <td class="px-2.5 py-1.5 text-gray-700 dark:text-gray-300" x-text="l.nama"></td>
                                    <td class="px-2.5 py-1.5 text-gray-700 dark:text-gray-300" x-text="l.wilayah"></td>
                                    <td class="px-2.5 py-1.5 text-gray-700 dark:text-gray-300" x-text="kategoriLabel[l.kategori]"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <div x-show="mapAsTable" x-cloak class="mt-3 flex flex-wrap gap-4 text-xs text-gray-400 dark:text-gray-500">
                    @foreach ($kategoriLabel as $key => $label)
                        <span class="flex items-center gap-1.5"><span class="h-2 w-2 rounded-full" style="background:{{ $kategoriColor[$key] }}"></span>{{ $label }}</span>
                    @endforeach
                </div>
            </div>

            <div class="animate-fade-up flex h-full flex-col rounded-2xl border border-gray-200 bg-white p-5 transition-shadow duration-200 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:350ms">
                <h3 class="text-sm font-bold text-gray-800 dark:text-white/90">Tren Kumulatif Emisi Tereduksi</h3>
                <div class="mb-1 mt-0.5 text-xs text-gray-400">Estimasi tCO₂e, kumulatif Jan–Ags 2026</div>
                @php
                    $trend = [12400, 29800, 54200, 79500, 108900, 142300, 178600, 214900];
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags'];
                @endphp
                <div id="chartEmisiTereduksi"
                     class="-ml-4 flex-1"
                     data-series="{{ json_encode($trend) }}"
                     data-categories="{{ json_encode($months) }}"></div>
            </div>
        </div>

        <div class="mb-10 grid gap-4 lg:grid-cols-2">
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-5 transition-shadow duration-200 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:400ms">
                <h3 class="text-sm font-bold text-gray-800 dark:text-white/90">Jumlah Titik Kegiatan per Kategori</h3>
                @php
                    $kategoriShortLabels = collect($kategoriLabel)->values()->map(fn ($l) => str_replace('Data ', '', $l))->all();
                    $kategoriColorList = collect($kategoriLabel)->keys()->map(fn ($k) => $kategoriColor[$k])->all();
                    $kategoriCounts = collect($kategoriLabel)->keys()->map(fn ($k) => $rows->where('kategori', $k)->count())->all();
                @endphp
                <div id="chartKategori" class="-ml-4 mt-2"
                     data-categories="{{ json_encode($kategoriShortLabels) }}"
                     data-colors="{{ json_encode($kategoriColorList) }}"
                     data-counts="{{ json_encode($kategoriCounts) }}"></div>
            </div>
            <div class="animate-fade-up rounded-2xl border border-gray-200 bg-white p-5 transition-shadow duration-200 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03]" style="animation-delay:450ms">
                <h3 class="text-sm font-bold text-gray-800 dark:text-white/90">Wilayah Teraktif</h3>
                @php
                    $regionRanking = $rows->groupBy('wilayah')->map->count()->sortDesc()->take(6);
                    $regionShortLabels = $regionRanking->keys()->map(fn ($w) => preg_replace('/^(Kab\.|Kota)\s+/', '', $w))->values()->all();
                @endphp
                <div x-show="regions.length > 0">
                    <div id="chartWilayah" class="-ml-4 mt-2"
                         data-categories="{{ json_encode($regionShortLabels) }}"
                         data-counts="{{ json_encode($regionRanking->values()->values()->all()) }}"
                         data-color="#1f6b46"></div>
                </div>
                <p x-show="regions.length === 0" x-cloak class="p-4 text-center text-sm text-gray-400">Tidak ada wilayah sesuai filter.</p>
            </div>
        </div>

        <p class="mb-10 text-xs leading-relaxed text-gray-400 dark:text-gray-500">
            Peta bersifat skematik untuk keperluan prototipe — lokasi presisi mengikuti data geospasial (.shp) yang diunggah Operator melalui Form Pengisian Data. Data baru tampil di sini setelah disetujui Admin (lihat status di Ruang Kerja). Fitur unduh data mentah &amp; Dashboard internal masih menunggu konfirmasi (Bagian 7).
        </p>
    </div>
    </div>
@endsection

@section('footer')
    @include('components.public.footer')
@endsection
