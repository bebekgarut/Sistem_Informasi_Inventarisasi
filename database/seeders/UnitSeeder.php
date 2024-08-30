<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->insert([
            ['KODE_UNITS' => 1, 'NAMA_UNITS' => 'Sekretariat DPRD', 'KODE_BIDANG' => 1],
            ['KODE_UNITS' => 2, 'NAMA_UNITS' => 'Sekretariat Daerah', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 3, 'NAMA_UNITS' => 'KECAMATAN KEMUNING', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 4, 'NAMA_UNITS' => 'KECAMATAN BUKIT KECIL', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 5, 'NAMA_UNITS' => 'KECAMATAN GANDUS', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 6, 'NAMA_UNITS' => 'KECAMATAN KERTAPATI', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 7, 'NAMA_UNITS' => 'KECAMATAN PLAJU', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 8, 'NAMA_UNITS' => 'KECAMATAN ILIR TIMUR I', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 9, 'NAMA_UNITS' => 'KECAMATAN ILIR TIMUR II', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 10, 'NAMA_UNITS' => 'KECAMATAN ILIR BARAT I', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 11, 'NAMA_UNITS' => 'KECAMATAN ILIR BARAT II', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 12, 'NAMA_UNITS' => 'KECAMATAN SEBERANG ULU I', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 13, 'NAMA_UNITS' => 'KECAMATAN SEBERANG ULU II', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 14, 'NAMA_UNITS' => 'KECAMATAN SEMATANG BORANG', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 15, 'NAMA_UNITS' => 'KECAMATAN SAKO', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 16, 'NAMA_UNITS' => 'KECAMATAN SUKARAMI', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 17, 'NAMA_UNITS' => 'KECAMATAN ALANG ALANG LEBAR', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 18, 'NAMA_UNITS' => 'KECAMATAN KALIDONI', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 19, 'NAMA_UNITS' => 'KECAMATAN JAKABARING', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 20, 'NAMA_UNITS' => 'KECAMATAN ILIR TIMUR III', 'KODE_BIDANG' => 2],
            ['KODE_UNITS' => 21, 'NAMA_UNITS' => 'Dinas Pekerjaan Umum dan Penata Ruang', 'KODE_BIDANG' => 3],
            ['KODE_UNITS' => 22, 'NAMA_UNITS' => 'Dinas Perumahan Rakyat dan Kawasan Pemukiman', 'KODE_BIDANG' => 3],
            ['KODE_UNITS' => 23, 'NAMA_UNITS' => 'Dinas Perhubungan Kota Palembang', 'KODE_BIDANG' => 4],
            ['KODE_UNITS' => 24, 'NAMA_UNITS' => 'Rumah Sakit Umum Daerah BARI', 'KODE_BIDANG' => 5],
            ['KODE_UNITS' => 25, 'NAMA_UNITS' => 'Dinas Kesehatan', 'KODE_BIDANG' => 5],
            ['KODE_UNITS' => 26, 'NAMA_UNITS' => 'RSUD GANDUS', 'KODE_BIDANG' => 5],
            ['KODE_UNITS' => 27, 'NAMA_UNITS' => 'Dinas Pendidikan', 'KODE_BIDANG' => 6],
            ['KODE_UNITS' => 28, 'NAMA_UNITS' => 'Dinas Kebudayaan', 'KODE_BIDANG' => 6],
            ['KODE_UNITS' => 29, 'NAMA_UNITS' => 'Dinas Kepemudaan dan Olahraga', 'KODE_BIDANG' => 6],
            ['KODE_UNITS' => 30, 'NAMA_UNITS' => 'DINAS SOSIAL KOTA PALEMBANG', 'KODE_BIDANG' => 7],
            ['KODE_UNITS' => 31, 'NAMA_UNITS' => 'DINAS PEMADAM KEBAKARAN DAN PENANGGULANGAN BENCANA', 'KODE_BIDANG' => 7],
            ['KODE_UNITS' => 32, 'NAMA_UNITS' => 'DINAS KETENAGAKERJAAN KOTA PALEMBANG', 'KODE_BIDANG' => 7],
            ['KODE_UNITS' => 33, 'NAMA_UNITS' => 'DINAS PEMBERDAYAAN PEREMPUAN PERLINDUNGAN ANAK DAN PEMBERDAYAAN MASYARAKAT', 'KODE_BIDANG' => 8],
            ['KODE_UNITS' => 34, 'NAMA_UNITS' => 'DINAS PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA', 'KODE_BIDANG' => 8],
            ['KODE_UNITS' => 35, 'NAMA_UNITS' => 'DINAS KEPENDUDUKAN & PENCATATAN SIPIL KOTA PALEMBANG', 'KODE_BIDANG' => 8],
            ['KODE_UNITS' => 36, 'NAMA_UNITS' => 'Dinas Pertanian dan Ketahanan Pangan', 'KODE_BIDANG' => 9],
            ['KODE_UNITS' => 37, 'NAMA_UNITS' => 'Dinas Perikanan', 'KODE_BIDANG' => 9],
            ['KODE_UNITS' => 38, 'NAMA_UNITS' => 'Dinas Koperasi dan Usaha Kecil dan Menengah	', 'KODE_BIDANG' => 10],
            ['KODE_UNITS' => 39, 'NAMA_UNITS' => 'Dinas Perdagangan', 'KODE_BIDANG' => 10],
            ['KODE_UNITS' => 40, 'NAMA_UNITS' => 'Dinas Perindustrian', 'KODE_BIDANG' => 10],
            ['KODE_UNITS' => 41, 'NAMA_UNITS' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu', 'KODE_BIDANG' => 11],
            ['KODE_UNITS' => 42, 'NAMA_UNITS' => 'Badan Pengelolaan Pajak Daerah', 'KODE_BIDANG' => 11],
            ['KODE_UNITS' => 43, 'NAMA_UNITS' => 'Inspektorat', 'KODE_BIDANG' => 12],
            ['KODE_UNITS' => 44, 'NAMA_UNITS' => 'Badan Pengelolaan Keuangan dan Aset Daerah', 'KODE_BIDANG' => 12],
            ['KODE_UNITS' => 45, 'NAMA_UNITS' => 'Badan Perencanaan Pembangunan Daerah', 'KODE_BIDANG' => 13],
            ['KODE_UNITS' => 46, 'NAMA_UNITS' => 'Dinas Lingkungan Hidup dan Kebersihan', 'KODE_BIDANG' => 14],
            ['KODE_UNITS' => 47, 'NAMA_UNITS' => 'Dinas Pariwisata', 'KODE_BIDANG' => 15],
            ['KODE_UNITS' => 48, 'NAMA_UNITS' => 'BADAN KESATUAN BANGSA DAN POLITIK', 'KODE_BIDANG' => 16],
            ['KODE_UNITS' => 49, 'NAMA_UNITS' => 'KESATUAN POL PP KOTA PALEMBANG', 'KODE_BIDANG' => 16],
            ['KODE_UNITS' => 50, 'NAMA_UNITS' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'KODE_BIDANG' => 15],
            ['KODE_UNITS' => 51, 'NAMA_UNITS' => 'DINAS KOMUNIKASI & INFORMATIKA', 'KODE_BIDANG' => 18],
            ['KODE_UNITS' => 52, 'NAMA_UNITS' => 'DINAS KEARSIPAN DAN PERPUSTAKAAN', 'KODE_BIDANG' => 18],
            ['KODE_UNITS' => 53, 'NAMA_UNITS' => 'Lainnya', 'KODE_BIDANG' => 20]

        ]);
    }
}
