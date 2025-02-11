<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kibb extends Model
{
    use HasFactory;

    protected $table = 'kibbs';

    protected $fillable = [
        'NAMA_BARANG',
        'KODE_BARANG',
        'NOMOR_REGISTER',
        'MERK_TYPE',
        'UKURAN_CC',
        'BAHAN',
        'TAHUN_PEMBELIAN',
        'NOMOR_PABRIK',
        'NOMOR_RANGKA',
        'NOMOR_MESIN',
        'NOMOR_POLISI',
        'NOMOR_BPKB',
        'PENGGUNA_BARANG',
        'ASAL_USUL',
        'HARGA',
        'KETERANGAN',
        'FOTO',
        'DOWNLOAD',
        'DOWNLOAD_2',
        'KODE_BIDANG',
        'KODE_UNITS',
        'KODE_SUB_UNITS',
        'KODE_UPB',
    ];
    protected $primaryKey = 'id';

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'KODE_BIDANG', 'KODE_BIDANG');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'KODE_UNITS', 'KODE_UNITS');
    }

    public function subunit()
    {
        return $this->belongsTo(Subunit::class, 'KODE_SUB_UNITS', 'KODE_SUB_UNITS');
    }

    public function upb()
    {
        return $this->belongsTo(UPB::class, 'KODE_UPB', 'KODE_UPB');
    }
}
