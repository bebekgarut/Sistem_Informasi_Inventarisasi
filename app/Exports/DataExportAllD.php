<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class DataExportAllD implements FromCollection, WithHeadings, WithMapping
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
            $row->nama_barang,
            $row->kode_barang,
            $row->nibar,
            $row->nomor_register,
            $row->spesifikasi_nama_barang,
            $row->spesifikasi_lainnya,
            $row->nomor_ruas_jalan,
            $row->nomor_ruas_jembatan,
            $row->nomor_ruas_jaringan_irigasi,
            $row->lokasi,
            $row->titik_koordinat,
            $row->status_kepemilikan_tanah,
            $row->jumlah,
            $row->satuan,
            $row->harga_satuan_perolehan,
            $row->cara_perolehan,
            $row->tanggal_perolehan,
            $row->nilai_perolehan,
            $row->status_penggunaan,
            $row->keterangan,
        ];
    }
}
