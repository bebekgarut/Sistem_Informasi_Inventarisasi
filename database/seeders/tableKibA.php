<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class tableKibA extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = storage_path('app/csv a.csv');

        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $rowData) {
            DB::table('kibas')->insert([
                'ID' => $rowData[0],
                'NAMA_BARANG' => $rowData[1],
                'KODE_BARANG' => $rowData[2],
                'NOMOR_REGISTER' => $rowData[3],
                'LUAS' => $rowData[4],
                'TAHUN_PENGADAAN' => $rowData[5],
                'LETAK_ALAMAT' => $rowData[6],
                'HAK' => $rowData[7] ?? '',
                'TANGGAL_SERTIFIKAT' => $rowData[8] !== '' ? $rowData[8] : null,
                'NO_SERTIFIKAT' => $rowData[9] ?? '',
                'PENGGUNA_BARANG' => $rowData[10],
                'PENGGUNAAN' => $rowData[11] ?? '',
                'ASAL_USUL' => $rowData[12] ?? '',
                'HARGA' => $rowData[13] ?? '',
                'KETERANGAN' => $rowData[14] ?? '',
                'KOORDINAT' => $rowData[15] ?? '',
                'LINK' => $rowData[16] ?? '',
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
     *
     * @param string $value
     * @return string
     */
    function cleanString($string)
    {
        return Str::of($string)->replace(['\xA0', '�'], ' ')->toString();
    }
}
