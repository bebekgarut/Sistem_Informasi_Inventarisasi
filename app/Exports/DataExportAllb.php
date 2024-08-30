<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;

class DataExportAllb implements FromCollection, WithHeadings, WithMapping, WithTitle
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
            $row->MERK_TYPE,
            $row->UKURAN_CC,
            $row->BAHAN,
            $row->TAHUN_PEMBELIAN,
            $row->NOMOR_PABRIK,
            $row->NOMOR_RANGKA,
            $row->NOMOR_MESIN,
            $row->NOMOR_POLISI,
            $row->NOMOR_BPKB,
            $row->ASAL_USUL,
            $row->HARGA,
            $row->KETERANGAN
        ];
    }

    public function title(): string
    {
        return 'Data KIB A';
    }
}
