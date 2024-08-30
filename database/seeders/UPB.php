<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class uPB extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('app/UPB.csv');
        $csvData = array_map('str_getcsv', file($csvFile));

        foreach ($csvData as $rowData) {
            DB::table('upbs')->insert([
                'KODE_UPB' => $rowData[0],
                'NAMA_UPB' => $rowData[1],
                'KODE_BIDANG' => $rowData[2] ?? '',
                'KODE_UNITS' => $rowData[3] ?? '',
                'KODE_SUB_UNITS' => $rowData[4] ?? '',


            ]);
        }
    }
    /**
     *
     * @param string $value
     * @return string
     */
}
