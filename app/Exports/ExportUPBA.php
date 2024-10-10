<?php

namespace App\Exports;

use App\Models\Kiba;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUPBA implements FromCollection, WithHeadings, WithMapping
{
    protected $KODE_UPB;

    public function __construct($KODE_UPB)
    {
        $this->KODE_UPB = $KODE_UPB;
    }

    public function collection()
    {
        return Kiba::where('KODE_UPB', $this->KODE_UPB)
            ->select(
                'NAMA_BARANG',
                'KODE_BARANG',
                'NOMOR_REGISTER',
                'LUAS',
                'TAHUN_PENGADAAN',
                'LETAK_ALAMAT',
                'HAK',
                'TANGGAL_SERTIFIKAT',
                'NO_SERTIFIKAT',
                'PENGGUNAAN',
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
            'Luas',
            'Tahun Pengadaan',
            'Letak/Alamat',
            'Hak',
            'Tanggal Sertifikat',
            'Nomor Sertifikat',
            'Penggunaan',
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
            $row->LUAS,
            $row->TAHUN_PENGADAAN,
            $row->LETAK_ALAMAT,
            $row->HAK,
            $row->TANGGAL_SERTIFIKAT,
            $row->NO_SERTIFIKAT,
            $row->PENGGUNAAN,
            $row->ASAL_USUL,
            $row->HARGA,
            $row->KETERANGAN
        ];
    }
}
