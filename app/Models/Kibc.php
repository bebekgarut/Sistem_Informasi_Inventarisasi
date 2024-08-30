<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kibc extends Model
{
    use HasFactory;

    protected $table = 'kibcs';

    protected $fillable = [
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
        'PENGGUNA_BARANG',
        'ASAL_USUL',
        'HARGA',
        'KETERANGAN',
        'FOTO',
        'LINK',
        'KOORDINAT',
        'DOWNLOAD',
        'KODE_BIDANG',
        'KODE_UNITS',
        'KODE_SUB_UNITS',
        'KODE_UPB',
    ];
    protected $primaryKey = 'ID';

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
