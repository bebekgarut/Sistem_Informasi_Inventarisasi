<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class tableKibD extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = storage_path('app/kesbangpol.csv');

        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $rowData) {
            DB::table('kibds')->insert([
                'id' => $rowData[0],
                'nama_barang' => $rowData[1],
                'kode_barang' => $rowData[2],
                'nibar' => $rowData[3],
                'nomor_register' => $rowData[4],
                'spesifikasi_nama_barang' => $rowData[5],
                'spesifkasi_lainnya'           => $rowData[6],
                'nomor_ruas_jalan'             => $rowData[7],
                'nomor_ruas_jembatan'          => $rowData[8],
                'nomor_ruas_jaringan_irigasi'  => $rowData[9],
                'lokasi'                       => $rowData[10],
                'titik_koordinat'              => $rowData[11],
                'status_kepemilikan_tanah'     => $rowData[12],
                'jumlah'                       => $rowData[13],
                'satuan'                       => $rowData[14],
                'harga_satuan_perolehan'       => $rowData[15],
                'cara_perolehan'               => $rowData[16],
                'tanggal_perolehan' => !empty($rowData[17])
                    ? Carbon::createFromFormat('n/j/Y', $rowData[17])->format('Y-m-d')
                    : null,
                'nilai_perolehan'              => $rowData[18],
                'status_penggunaan'            => $rowData[19],
                'keterangan'                   => $rowData[20],
                'PENGGUNA_BARANG'              => $rowData[21],
                'FOTO'                         => $rowData[22],
                'DOWNLOAD'                     => $rowData[23],
                'KODE_BIDANG'                  => $rowData[24],
                'KODE_UNITS'                   => $rowData[25],
                'KODE_SUB_UNITS'               => $rowData[26],
                'KODE_UPB'                     => $rowData[27],

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
