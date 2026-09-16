<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Publikasi;

class PublicController extends Controller
{
    public function beranda()
    {
        $terbit = Lokasi::where('status', 'terbit');

        return view('pages.public.beranda', [
            'title' => 'Beranda',
            'publikasi' => Publikasi::orderByDesc('tanggal')->get(),
            'tipeList' => Publikasi::TIPE_LIST,
            'totalLuas' => Lokasi::where('status', 'terbit')->sum('luas'),
            'kategoriCounts' => [
                'hutan' => (clone $terbit)->where('kategori', 'hutan')->count(),
                'program' => (clone $terbit)->where('kategori', 'program')->count(),
                'monitoring' => (clone $terbit)->where('kategori', 'monitoring')->count(),
            ],
        ]);
    }

    public function dashboard()
    {
        return view('pages.public.dashboard', [
            'title' => 'Dashboard Capaian',
            'lokasi' => Lokasi::where('status', 'terbit')->get(),
            'wilayahList' => Lokasi::query()->distinct()->orderBy('wilayah')->pluck('wilayah'),
            'publikasiCount' => Publikasi::count(),
            'tipeAktif' => Publikasi::distinct('tipe')->count('tipe'),
        ]);
    }
}
