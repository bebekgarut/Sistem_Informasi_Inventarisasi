<?php

namespace App\Exports;

use App\Models\Kibb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUPBB implements FromCollection, WithHeadings, WithMapping
{
    protected $KODE_UPB;

    public function __construct($KODE_UPB)
    {
        $this->KODE_UPB = $KODE_UPB;
    }


    public function collection()
    {
        return Kibb::where('KODE_UPB', $this->KODE_UPB)
            ->select(
                'NAMA_BARANG',
                'KODE_BARANG',
                'NOMOR_REGISTER',
                'MERK_TYPE',
                'UKURAN_CC',
                'BAHAN',
                'TAHUN_PEMBELIAN',
                'NOMOR_PABRIK',
                'NOMOR_MESIN',
                'NOMOR_POLISI',
                'NOMOR_BPKB',
                'ASAL_USUL',
                'HARGA',
                'KETERANGAN',
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Barang/Jenis Barang',
            'Kode Barang',
            'Nomor Register',
            'Merk/Type',
            'Ukuran/CC',
            'Bahan',
            'Tahun Pembelian',
            'Nomor Pabrik',
            'Nomor Rangka',
            'Nomor Mesin',
            'Nomor Polisi',
            'Nomor BPKB',
            'Asal Usul',
            'Harga(Dalam Ribuan)',
            'Keterangan'
        ];
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
}
