<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;

class DataExportAlla implements FromCollection, WithHeadings, WithMapping
{
    protected $all;
    protected $columnsall;

    public function __construct(Collection $all, array $columnsall)
    {
        $this->all = $all;
        $this->columnsall = $columnsall;
    }

    public function collection()
    {
        return $this->all;
    }

    public function headings(): array
    {
        return $this->columnsall;
    }

    public function map($row): array
    {
        static $rowIndex = 0;
        $rowIndex++;
        return [
            $rowIndex,
            $row->NAMA_BARANG,
            $row->KODE_BARANG,
            $row->NOMOR_REGISTER,
            $row->LUAS,
            $row->TAHUN_PENGADAAN,
            $row->LETAK_ALAMAT,
            $row->HAK,
            $row->TANGGAL_SERTIFIKAT,
            $row->NO_SERTIFIKAT,
            $row->PENGGUNA_BARANG,
            $row->PENGGUNAAN,
            $row->ASAL_USUL,
            $row->HARGA,
            $row->KETERANGAN,
            $row->KOORDINAT
        ];
    }
}
