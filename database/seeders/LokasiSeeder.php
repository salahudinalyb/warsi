<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['kode' => 'RBP-1001', 'nama' => 'Batas Areal Restorasi Blok Sitinjau', 'wilayah' => 'Kab. Solok', 'kategori' => 'hutan', 'bulan' => 2, 'luas' => 1840, 'penerima' => 0, 'x' => 0.32, 'y' => 0.62, 'status' => 'terbit'],
            ['kode' => 'RBP-1002', 'nama' => 'Patroli Hutan Nagari Sungai Naniang', 'wilayah' => 'Kab. Lima Puluh Kota', 'kategori' => 'monitoring', 'bulan' => 3, 'luas' => 960, 'penerima' => 0, 'x' => 0.55, 'y' => 0.20, 'status' => 'terbit'],
            ['kode' => 'RBP-1003', 'nama' => 'Kelompok Tani Hutan Rimbo Sakato', 'wilayah' => 'Kab. Dharmasraya', 'kategori' => 'program', 'bulan' => 1, 'luas' => 0, 'penerima' => 210, 'x' => 0.70, 'y' => 0.72, 'status' => 'menunggu'],
            ['kode' => 'RBP-1004', 'nama' => 'Plot Karbon Permanen TNKS Sektor Solok Selatan', 'wilayah' => 'Kab. Solok Selatan', 'kategori' => 'monitoring', 'bulan' => 5, 'luas' => 2100, 'penerima' => 0, 'x' => 0.40, 'y' => 0.80, 'status' => 'terbit'],
            ['kode' => 'RBP-1005', 'nama' => 'Sekolah Lapang Agroforestri Pasaman', 'wilayah' => 'Kab. Pasaman', 'kategori' => 'program', 'bulan' => 4, 'luas' => 0, 'penerima' => 145, 'x' => 0.42, 'y' => 0.06, 'status' => 'terbit'],
            ['kode' => 'RBP-1006', 'nama' => 'Batas Hutan Adat Nagari Sungai Buluh', 'wilayah' => 'Kab. Padang Pariaman', 'kategori' => 'hutan', 'bulan' => 6, 'luas' => 1320, 'penerima' => 0, 'x' => 0.30, 'y' => 0.42, 'status' => 'menunggu'],
            ['kode' => 'RBP-1007', 'nama' => 'Monitoring Deforestasi Mentawai Utara', 'wilayah' => 'Kab. Kep. Mentawai', 'kategori' => 'monitoring', 'bulan' => 7, 'luas' => 3200, 'penerima' => 0, 'x' => 0.06, 'y' => 0.60, 'status' => 'terbit'],
            ['kode' => 'RBP-1008', 'nama' => 'Koperasi Madu Hutan Pesisir Selatan', 'wilayah' => 'Kab. Pesisir Selatan', 'kategori' => 'program', 'bulan' => 2, 'luas' => 0, 'penerima' => 88, 'x' => 0.34, 'y' => 0.90, 'status' => 'terbit'],
            ['kode' => 'RBP-1009', 'nama' => 'Batas Kawasan Lindung Bukit Barisan', 'wilayah' => 'Kab. Agam', 'kategori' => 'hutan', 'bulan' => 8, 'luas' => 1580, 'penerima' => 0, 'x' => 0.44, 'y' => 0.14, 'status' => 'menunggu'],
            ['kode' => 'RBP-1010', 'nama' => 'Patroli Bersama MPA Sijunjung', 'wilayah' => 'Kab. Sijunjung', 'kategori' => 'monitoring', 'bulan' => 6, 'luas' => 870, 'penerima' => 0, 'x' => 0.63, 'y' => 0.55, 'status' => 'terbit'],
            ['kode' => 'RBP-1011', 'nama' => 'Pelatihan Pemetaan Partisipatif Tanah Datar', 'wilayah' => 'Kab. Tanah Datar', 'kategori' => 'program', 'bulan' => 3, 'luas' => 0, 'penerima' => 62, 'x' => 0.47, 'y' => 0.30, 'status' => 'terbit'],
            ['kode' => 'RBP-1012', 'nama' => 'Restorasi Gambut Pasaman Barat', 'wilayah' => 'Kab. Pasaman Barat', 'kategori' => 'hutan', 'bulan' => 5, 'luas' => 990, 'penerima' => 0, 'x' => 0.24, 'y' => 0.10, 'status' => 'terbit'],
            ['kode' => 'RBP-1013', 'nama' => 'Verifikasi Lapangan Blok Karbon Bukittinggi', 'wilayah' => 'Kota Bukittinggi', 'kategori' => 'monitoring', 'bulan' => 8, 'luas' => 410, 'penerima' => 0, 'x' => 0.50, 'y' => 0.18, 'status' => 'menunggu'],
            ['kode' => 'RBP-1014', 'nama' => 'Forum Nagari Peduli Hutan Payakumbuh', 'wilayah' => 'Kota Payakumbuh', 'kategori' => 'program', 'bulan' => 7, 'luas' => 0, 'penerima' => 130, 'x' => 0.58, 'y' => 0.16, 'status' => 'terbit'],
            ['kode' => 'RBP-1015', 'nama' => 'Pelatihan Agroforestri Nagari Talang Babungo', 'wilayah' => 'Kab. Solok', 'kategori' => 'program', 'bulan' => 4, 'luas' => 0, 'penerima' => 95, 'x' => 0.33, 'y' => 0.63, 'status' => 'terbit'],
            ['kode' => 'RBP-1016', 'nama' => 'Patroli Rutin Kawasan Danau Diatas', 'wilayah' => 'Kab. Solok', 'kategori' => 'monitoring', 'bulan' => 6, 'luas' => 640, 'penerima' => 0, 'x' => 0.31, 'y' => 0.64, 'status' => 'terbit'],
            ['kode' => 'RBP-1017', 'nama' => 'Restorasi Hutan Nagari Air Batumbuk', 'wilayah' => 'Kab. Solok', 'kategori' => 'hutan', 'bulan' => 7, 'luas' => 1100, 'penerima' => 0, 'x' => 0.34, 'y' => 0.61, 'status' => 'terbit'],
            ['kode' => 'RBP-1018', 'nama' => 'Koperasi Hasil Hutan Bukan Kayu Suliki', 'wilayah' => 'Kab. Lima Puluh Kota', 'kategori' => 'program', 'bulan' => 5, 'luas' => 0, 'penerima' => 70, 'x' => 0.56, 'y' => 0.21, 'status' => 'terbit'],
            ['kode' => 'RBP-1019', 'nama' => 'Batas Hutan Lindung Nagari Harau', 'wilayah' => 'Kab. Lima Puluh Kota', 'kategori' => 'hutan', 'bulan' => 2, 'luas' => 800, 'penerima' => 0, 'x' => 0.54, 'y' => 0.19, 'status' => 'terbit'],
            ['kode' => 'RBP-1020', 'nama' => 'Monitoring Kebakaran Lahan Pasaman', 'wilayah' => 'Kab. Pasaman', 'kategori' => 'monitoring', 'bulan' => 8, 'luas' => 500, 'penerima' => 0, 'x' => 0.43, 'y' => 0.07, 'status' => 'terbit'],
            ['kode' => 'RBP-1021', 'nama' => 'Restorasi Hutan Nagari Muaro Bodi', 'wilayah' => 'Kab. Sijunjung', 'kategori' => 'hutan', 'bulan' => 3, 'luas' => 700, 'penerima' => 0, 'x' => 0.64, 'y' => 0.56, 'status' => 'terbit'],
            ['kode' => 'RBP-1022', 'nama' => 'Monitoring Karbon Rimbo Panjang Dharmasraya', 'wilayah' => 'Kab. Dharmasraya', 'kategori' => 'monitoring', 'bulan' => 6, 'luas' => 450, 'penerima' => 0, 'x' => 0.71, 'y' => 0.73, 'status' => 'terbit'],
            ['kode' => 'RBP-1023', 'nama' => 'Restorasi Mangrove Pesisir Kota Padang', 'wilayah' => 'Kota Padang', 'kategori' => 'hutan', 'bulan' => 1, 'luas' => 1450, 'penerima' => 0, 'x' => 0.35, 'y' => 0.68, 'status' => 'terbit'],
            ['kode' => 'RBP-1024', 'nama' => 'Verifikasi Citra Satelit Kawasan Pantai Padang', 'wilayah' => 'Kota Padang', 'kategori' => 'monitoring', 'bulan' => 5, 'luas' => 320, 'penerima' => 0, 'x' => 0.36, 'y' => 0.69, 'status' => 'terbit'],
            ['kode' => 'RBP-1025', 'nama' => 'Kelompok Nelayan Sadar Mangrove Padang', 'wilayah' => 'Kota Padang', 'kategori' => 'program', 'bulan' => 3, 'luas' => 0, 'penerima' => 175, 'x' => 0.34, 'y' => 0.70, 'status' => 'terbit'],
            ['kode' => 'RBP-1026', 'nama' => 'Batas Kawasan Hutan Kota Padang Panjang', 'wilayah' => 'Kota Padang Panjang', 'kategori' => 'hutan', 'bulan' => 6, 'luas' => 210, 'penerima' => 0, 'x' => 0.46, 'y' => 0.28, 'status' => 'menunggu'],
            ['kode' => 'RBP-1027', 'nama' => 'Patroli Gambut Pesisir Pariaman', 'wilayah' => 'Kota Pariaman', 'kategori' => 'monitoring', 'bulan' => 4, 'luas' => 380, 'penerima' => 0, 'x' => 0.28, 'y' => 0.44, 'status' => 'terbit'],
            ['kode' => 'RBP-1028', 'nama' => 'Reboisasi Lahan Bekas Tambang Sawahlunto', 'wilayah' => 'Kota Sawahlunto', 'kategori' => 'hutan', 'bulan' => 2, 'luas' => 890, 'penerima' => 0, 'x' => 0.60, 'y' => 0.58, 'status' => 'terbit'],
            ['kode' => 'RBP-1029', 'nama' => 'Sekolah Lapang Petani Kopi Agam', 'wilayah' => 'Kab. Agam', 'kategori' => 'program', 'bulan' => 5, 'luas' => 0, 'penerima' => 110, 'x' => 0.45, 'y' => 0.15, 'status' => 'terbit'],
            ['kode' => 'RBP-1030', 'nama' => 'Monitoring Kualitas Air Danau Maninjau', 'wilayah' => 'Kab. Agam', 'kategori' => 'monitoring', 'bulan' => 7, 'luas' => 560, 'penerima' => 0, 'x' => 0.44, 'y' => 0.13, 'status' => 'menunggu'],
            ['kode' => 'RBP-1031', 'nama' => 'Koperasi Gula Aren Lubuk Alung', 'wilayah' => 'Kab. Padang Pariaman', 'kategori' => 'program', 'bulan' => 1, 'luas' => 0, 'penerima' => 84, 'x' => 0.31, 'y' => 0.43, 'status' => 'terbit'],
            ['kode' => 'RBP-1032', 'nama' => 'Perlindungan Hutan Adat Nagari Pariangan', 'wilayah' => 'Kab. Tanah Datar', 'kategori' => 'hutan', 'bulan' => 8, 'luas' => 670, 'penerima' => 0, 'x' => 0.48, 'y' => 0.31, 'status' => 'terbit'],
            ['kode' => 'RBP-1033', 'nama' => 'Survei Deforestasi Batusangkar', 'wilayah' => 'Kab. Tanah Datar', 'kategori' => 'monitoring', 'bulan' => 3, 'luas' => 300, 'penerima' => 0, 'x' => 0.47, 'y' => 0.29, 'status' => 'ditolak'],
            ['kode' => 'RBP-1034', 'nama' => 'Restorasi Ekosistem Gambut Air Pura', 'wilayah' => 'Kab. Pesisir Selatan', 'kategori' => 'hutan', 'bulan' => 6, 'luas' => 1250, 'penerima' => 0, 'x' => 0.33, 'y' => 0.91, 'status' => 'terbit'],
            ['kode' => 'RBP-1035', 'nama' => 'Pelatihan Ekowisata Mandeh', 'wilayah' => 'Kab. Pesisir Selatan', 'kategori' => 'program', 'bulan' => 2, 'luas' => 0, 'penerima' => 132, 'x' => 0.35, 'y' => 0.89, 'status' => 'menunggu'],
            ['kode' => 'RBP-1036', 'nama' => 'Patroli Bersama Hutan Lindung Pasaman Barat', 'wilayah' => 'Kab. Pasaman Barat', 'kategori' => 'monitoring', 'bulan' => 5, 'luas' => 410, 'penerima' => 0, 'x' => 0.23, 'y' => 0.09, 'status' => 'terbit'],
            ['kode' => 'RBP-1037', 'nama' => 'Penanaman Kembali Blok Karbon Koto Baru', 'wilayah' => 'Kab. Dharmasraya', 'kategori' => 'hutan', 'bulan' => 7, 'luas' => 980, 'penerima' => 0, 'x' => 0.72, 'y' => 0.71, 'status' => 'terbit'],
            ['kode' => 'RBP-1038', 'nama' => 'Kelompok Tani Kopi Liki Sungai Pagu', 'wilayah' => 'Kab. Solok Selatan', 'kategori' => 'program', 'bulan' => 4, 'luas' => 0, 'penerima' => 58, 'x' => 0.41, 'y' => 0.81, 'status' => 'terbit'],
            ['kode' => 'RBP-1039', 'nama' => 'Pemetaan Hutan Adat Siberut', 'wilayah' => 'Kab. Kep. Mentawai', 'kategori' => 'hutan', 'bulan' => 8, 'luas' => 1520, 'penerima' => 0, 'x' => 0.05, 'y' => 0.59, 'status' => 'menunggu'],
            ['kode' => 'RBP-1040', 'nama' => 'Koperasi Rotan Lubuk Tarok', 'wilayah' => 'Kab. Sijunjung', 'kategori' => 'program', 'bulan' => 6, 'luas' => 0, 'penerima' => 96, 'x' => 0.65, 'y' => 0.54, 'status' => 'terbit'],
            ['kode' => 'RBP-1041', 'nama' => 'Verifikasi Lapangan Blok Suliki', 'wilayah' => 'Kab. Lima Puluh Kota', 'kategori' => 'monitoring', 'bulan' => 1, 'luas' => 450, 'penerima' => 0, 'x' => 0.57, 'y' => 0.22, 'status' => 'ditolak'],
        ];

        foreach ($rows as $row) {
            Lokasi::updateOrCreate(['kode' => $row['kode']], $row);
        }
    }
}
