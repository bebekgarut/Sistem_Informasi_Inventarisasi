<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tableKibC extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = storage_path('app/csv c.csv');

        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $rowData) {
            DB::table('kibcs')->insert([
                'ID' => $rowData[0],
                'NAMA_BARANG' => $rowData[1],
                'KODE_BARANG' => $rowData[2],
                'NOMOR_REGISTER' => $rowData[3],
                'KONDISI_BANGUNAN' => $rowData[4],
                'BANGUNAN_BERTINGKAT' => $rowData[5],
                'BANGUNAN_BETON' => $rowData[6],
                'LUAS_LANTAI' => $rowData[7] ?? '',
                'LETAK_ALAMAT' => $rowData[8] ?? '',
                'TANGGAL_DOKUMEN' => $rowData[9] !== '' ? $rowData[9] : null,
                'NOMOR_DOKUMEN' => $rowData[10] ?? '',
                'LUAS' => $rowData[11],
                'STATUS_TANAH' => $rowData[12] ?? '',
                'NOMOR_KODE_TANAH' => $rowData[13] ?? '',
                'PENGGUNA_BARANG' => $rowData[14],
                'ASAL_USUL' => $rowData[15] ?? '',
                'HARGA' => $rowData[16] ?? '',
                'KETERANGAN' => $rowData[17] ?? '',
                'FOTO' => $rowData[18] ?? '',
                'LINK' => $rowData[19] ?? '',
                'KOORDINAT' => $rowData[20] ?? '',
                'DOWNLOAD' => $rowData[21] ?? '',

                'KODE_BIDANG' => $rowData[22] ?? '',
                'KODE_UNITS' => $rowData[23] ?? '',
                'KODE_SUB_UNITS' => $rowData[24] ?? '',
                'KODE_UPB' => $rowData[25] ?? '',


            ]);
        }
    }
}
