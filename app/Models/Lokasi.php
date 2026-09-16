<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'nama', 'wilayah', 'kategori', 'bulan', 'luas', 'penerima', 'x', 'y', 'status',
        'sumber', 'deskripsi', 'ig_path', 'ig_filename', 'ig_size', 'style_path', 'style_filename',
    ];

    protected $casts = [
        'bulan' => 'integer',
        'luas' => 'integer',
        'penerima' => 'integer',
        'x' => 'float',
        'y' => 'float',
    ];

    const KATEGORI_LABEL = [
        'hutan' => 'Data Kehutanan',
        'program' => 'Data Program',
        'monitoring' => 'Data Monitoring',
    ];

    const BULAN_LABEL = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Ags', 9 => 'Sep'];

    public function kategoriLabel(): string
    {
        return self::KATEGORI_LABEL[$this->kategori] ?? $this->kategori;
    }

    public function bulanLabel(): string
    {
        return self::BULAN_LABEL[$this->bulan] ?? (string) $this->bulan;
    }
}
