<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;
use App\Models\Kibc;

class DataExportc implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $kib;
    protected $columnsc;

    public function __construct(Collection $kib, array $columnsc)
    {
        $this->kib = $kib;
        $this->columnsc = $columnsc;
    }

    public function collection()
    {
        return $this->kib;
    }

    public function headings(): array
    {
        return $this->columnsc;
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
            $row->KONDISI_BANGUNAN,
            $row->BANGUNAN_BERTINGKAT,
            $row->BANGUNAN_BETON,
            $row->LUAS_LANTAI,
            $row->LETAK_ALAMAT,
            $row->TANGGAL_DOKUMEN,
            $row->NOMOR_DOKUMEN,
            $row->LUAS,
            $row->STATUS_TANAH,
            $row->NOMOR_KODE_BARANG,
            $row->ASAL_USUL,
            $row->HARGA,
            $row->KETERANGAN
        ];
    }

    public function title(): string
    {
        return 'Data KIB C';
    }
}
