<?php

namespace Database\Seeders;

use App\Models\Publikasi;
use Illuminate\Database\Seeder;

class PublikasiSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['tipe' => 'praktik', 'label' => 'Praktik Baik', 'judul' => 'Pola Tumpang Sari Kopi-Kemenyan Kurangi Tekanan ke Hutan Lindung', 'wilayah' => 'Kab. Solok', 'tanggal' => '2026-08-12', 'ringkasan' => 'Kelompok tani di lereng Talang menggabungkan kopi dan kemenyan agar tak perlu membuka lahan baru di kawasan hutan.'],
            ['tipe' => 'cerita', 'label' => 'Cerita Perubahan', 'judul' => 'Dari Penebang Menjadi Penjaga: Kisah Patroli Nagari Sungai Naniang', 'wilayah' => 'Kab. Lima Puluh Kota', 'tanggal' => '2026-08-03', 'ringkasan' => 'Bekas pelaku illegal logging kini memimpin unit patroli swadaya nagari, hasil pendampingan program selama dua tahun.'],
            ['tipe' => 'laporan-mitigasi', 'label' => 'Laporan Mitigasi', 'judul' => 'Estimasi Penurunan Emisi Semester I 2026 — Sektor Kehutanan Sumbar', 'wilayah' => 'Provinsi', 'tanggal' => '2026-07-28', 'ringkasan' => 'Rekap perhitungan tCO2e tereduksi dari kegiatan restorasi dan perlindungan kawasan periode Januari-Juni.'],
            ['tipe' => 'artikel', 'label' => 'Artikel', 'judul' => 'Mengenal Skema RBP: Kenapa Hasil, Bukan Sekadar Kegiatan, yang Dibayar', 'wilayah' => 'Provinsi', 'tanggal' => '2026-07-19', 'ringkasan' => 'Penjelasan ringkas skema Result-Based Payment REDD+ bagi mitra nagari yang baru bergabung.'],
            ['tipe' => 'laporan-program', 'label' => 'Laporan Program', 'judul' => 'Laporan Triwulan II: Pendampingan 14 Nagari Dampingan', 'wilayah' => 'Provinsi', 'tanggal' => '2026-07-15', 'ringkasan' => 'Ringkasan capaian pendampingan kelembagaan, pelatihan, dan verifikasi lapangan triwulan kedua.'],
            ['tipe' => 'foto', 'label' => 'Foto & Video', 'judul' => 'Dokumentasi Verifikasi Plot Karbon TNKS Solok Selatan', 'wilayah' => 'Kab. Solok Selatan', 'tanggal' => '2026-07-02', 'ringkasan' => 'Galeri foto proses pengukuran biomassa oleh tim lapangan bersama masyarakat nagari.'],
            ['tipe' => 'produk', 'label' => 'Produk Pembelajaran', 'judul' => 'Modul Pelatihan: Pemetaan Partisipatif Batas Hutan Adat', 'wilayah' => 'Provinsi', 'tanggal' => '2026-06-21', 'ringkasan' => 'Modul yang dipakai memandu 12 nagari menuntaskan pemetaan batas hutan adat secara mandiri.'],
            ['tipe' => 'cerita', 'label' => 'Cerita Perubahan', 'judul' => 'Madu Hutan Pesisir Selatan Kini Tembus Pasar Padang', 'wilayah' => 'Kab. Pesisir Selatan', 'tanggal' => '2026-06-08', 'ringkasan' => 'Koperasi madu hutan binaan program mulai memasok toko oleh-oleh di kota, menaikkan nilai jual 3x lipat.'],
        ];

        foreach ($rows as $row) {
            Publikasi::updateOrCreate(['judul' => $row['judul']], $row);
        }
    }
}
