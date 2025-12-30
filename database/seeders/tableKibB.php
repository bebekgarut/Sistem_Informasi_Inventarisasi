<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tableKibB extends Seeder
{
    public function run()
    {
        $csvFile = storage_path('app/csv b.csv');

        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $rowData) {
            DB::table('kibbs')->insert([
                'ID' => $rowData[0],
                'NAMA_BARANG' => $rowData[1],
                'KODE_BARANG' => $rowData[2],
                'NOMOR_REGISTER' => $rowData[3],
                'MERK_TYPE' => $rowData[4],
                'UKURAN_CC' => $rowData[5],
                'BAHAN' => $rowData[6],
                'TAHUN_PEMBELIAN' => $rowData[7] ?? '',
                'NOMOR_PABRIK' => $rowData[8] ?? '',
                'NOMOR_RANGKA' => $rowData[9] ?? '',
                'NOMOR_MESIN' => $rowData[10] ?? '',
                'NOMOR_POLISI' => $rowData[11] ?? '',
                'NOMOR_BPKB' => $rowData[12] ?? '',
                'PENGGUNA_BARANG' => $rowData[13],
                'ASAL_USUL' => $rowData[14] ?? '',
                'HARGA' => $rowData[15] ?? '',
                'KETERANGAN' => $rowData[16] ?? '',
                'FOTO' => $rowData[17] ?? '',
                'DOWNLOAD' => $rowData[18] ?? '',

                'KODE_BIDANG' => $rowData[19] ?? '',
                'KODE_UNITS' => $rowData[20] ?? '',
                'KODE_SUB_UNITS' => $rowData[21] ?? '',
                'KODE_UPB' => $rowData[22] ?? '',


            ]);
        }
    }
    /**
     * Bersihkan string dari karakter tidak valid.
     *
     * @param string $value
     * @return string
     */
    // public function cleanString($value)
    // {
    //     // Ganti karakter \xA0 dengan spasi biasa
    //     $cleanedValue = str_replace("\xA0, \xA0DR,\xA0C", " ", $value);

    //     // Return cleaned value
    //     return $cleanedValue;
    // }
}
