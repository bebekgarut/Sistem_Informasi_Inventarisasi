<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;
use App\Models\Kiba;

class DataExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $data;
    protected $columns;

    public function __construct(Collection $data, array $columns)
    {
        $this->data = $data;
        $this->columns = $columns;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->columns;
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
            $row->PENGGUNAAN,
            $row->ASAL_USUL,
            $row->HARGA,
            $row->KETERANGAN,
            $row->KOORDINAT
        ];
    }

    public function title(): string
    {
        return 'Data KIB A';
    }
}
