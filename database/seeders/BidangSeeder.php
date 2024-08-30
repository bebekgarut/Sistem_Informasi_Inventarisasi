<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    public function run()
    {
        DB::table('bidangs')->insert([
            ['KODE_BIDANG' => 1, 'NAMA_BIDANG' => 'Sekwan/DPRD'],
            ['KODE_BIDANG' => 2, 'NAMA_BIDANG' => 'Sekretariat Daerah'],
            ['KODE_BIDANG' => 3, 'NAMA_BIDANG' => 'Bidang Kimpraswil/PU'],
            ['KODE_BIDANG' => 4, 'NAMA_BIDANG' => 'Bidang Perhubungan'],
            ['KODE_BIDANG' => 5, 'NAMA_BIDANG' => 'Bidang Kesehatan'],
            ['KODE_BIDANG' => 6, 'NAMA_BIDANG' => 'Bidang Pendidikan dan Kebudayaan'],
            ['KODE_BIDANG' => 7, 'NAMA_BIDANG' => 'Bidang Sosial'],
            ['KODE_BIDANG' => 8, 'NAMA_BIDANG' => 'Bidang Kependudukan'],
            ['KODE_BIDANG' => 9, 'NAMA_BIDANG' => 'Bidang Pertanian'],
            ['KODE_BIDANG' => 10, 'NAMA_BIDANG' => 'Bidang Perindustrian'],
            ['KODE_BIDANG' => 11, 'NAMA_BIDANG' => 'Bidang Pendapatan'],
            ['KODE_BIDANG' => 12, 'NAMA_BIDANG' => 'Bidang Pengawasan'],
            ['KODE_BIDANG' => 13, 'NAMA_BIDANG' => 'Bidang Perencanaan'],
            ['KODE_BIDANG' => 14, 'NAMA_BIDANG' => 'Bidang Lingkungan Hidup'],
            ['KODE_BIDANG' => 15, 'NAMA_BIDANG' => 'Bidang Pariwisata'],
            ['KODE_BIDANG' => 16, 'NAMA_BIDANG' => 'Bidang Kesatuan Bangsa'],
            ['KODE_BIDANG' => 17, 'NAMA_BIDANG' => 'Bidang Kepegawaian'],
            ['KODE_BIDANG' => 18, 'NAMA_BIDANG' => 'Bidang Komunikasi Informasi dan Dokumentasi'],
            ['KODE_BIDANG' => 19, 'NAMA_BIDANG' => 'Bidang BUMD'],
            ['KODE_BIDANG' => 20, 'NAMA_BIDANG' => 'Lainnya']
        ]);
    }
}
