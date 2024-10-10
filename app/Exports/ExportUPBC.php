<?php

namespace App\Exports;


use App\Models\Kibc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUPBC implements FromCollection, WithHeadings, WithMapping
{
    protected $KODE_UPB;

    public function __construct($KODE_UPB)
    {
        $this->KODE_UPB = $KODE_UPB;
    }

    public function collection()
    {
        return Kibc::where('KODE_UPB', $this->KODE_UPB)
            ->select(
                'NAMA_BARANG',
                'KODE_BARANG',
                'NOMOR_REGISTER',
                'KONDISI_BANGUNAN',
                'BANGUNAN_BERTINGKAT',
                'BANGUNAN_BETON',
                'LUAS_LANTAI',
                'LETAK_ALAMAT',
                'TANGGAL_DOKUMEN',
                'NOMOR_DOKUMEN',
                'LUAS',
                'STATUS_TANAH',
                'NOMOR_KODE_TANAH',
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
            'Kondisi Bangunan',
            'Bangunan Bertingkat',
            'Bangunan Beton',
            'Luas Lantai',
            'Letak/Alamat',
            'Tanggal Dokumen',
            'Nomor Dokumen',
            'Luas',
            'Status Tanah',
            'Nomor Kode Tanah',
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
}
