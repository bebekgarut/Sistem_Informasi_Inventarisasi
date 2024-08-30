<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Collection;
use App\Models\Kibb;

class DataExportb implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $kibb;
    protected $columnsb;

    public function __construct(Collection $kibb, array $columnsb)
    {
        $this->kibb = $kibb;
        $this->columnsb = $columnsb;
    }

    public function collection()
    {
        return $this->kibb;
    }

    public function headings(): array
    {
        return $this->columnsb;
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
            // Tambahkan kolom lainnya jika diperlukan
        ];
    }

    public function title(): string
    {
        return 'Data KIB B'; // Judul atau nama sheet Excel
    }
}
