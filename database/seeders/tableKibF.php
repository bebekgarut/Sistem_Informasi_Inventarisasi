<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class tableKibF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = storage_path('app/aset lainnya.csv');

        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $rowData) {
            DB::table('kibfs')->insert(
                [
                    'id'                         => $rowData[0],
                    'kode_barang'                => $rowData[1],
                    'nama_barang'                => $rowData[2],
                    'nibar'                      => $rowData[3],
                    'nomor_register'             => $rowData[4],
                    'spesifikasi_nama_barang'     => $rowData[5],
                    'spesifikasi_lainnya'        => $rowData[6],
                    'lokasi'                     => $rowData[7],
                    'jumlah'                     => $rowData[8],
                    'satuan'                     => $rowData[9],
                    'harga_satuan_perolehan'     => $rowData[10],
                    'nilai_perolehan'            => $rowData[11],
                    'cara_perolehan'             => $rowData[12],
                    'tanggal_perolehan'          => $rowData[13],
                    'status_penggunaan'          => $rowData[14],
                    'keterangan'                 => $rowData[15],
                    'PENGGUNA_BARANG'            => $rowData[16],
                    'FOTO'                       => $rowData[17],
                    'DOWNLOAD'                   => $rowData[18],
                    'KODE_BIDANG'                => $rowData[19],
                    'KODE_UNITS'                 => $rowData[20],
                    'KODE_SUB_UNITS'             => $rowData[21],
                    'KODE_UPB'                   => $rowData[22],
                ]
            );
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
