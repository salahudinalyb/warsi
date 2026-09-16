<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;

    protected $fillable = ['tipe', 'label', 'judul', 'wilayah', 'tanggal', 'ringkasan'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    const TIPE_LIST = [
        'laporan-mitigasi' => 'Laporan Mitigasi',
        'laporan-program' => 'Laporan Program',
        'artikel' => 'Artikel & Publikasi',
        'praktik' => 'Praktik Baik',
        'cerita' => 'Cerita Perubahan',
        'foto' => 'Foto & Video',
        'produk' => 'Produk Pembelajaran',
    ];
}
