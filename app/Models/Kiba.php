<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kiba extends Model
{
    use HasFactory;

    protected $table = 'kibas';

    protected $fillable = [
        'NAMA_BARANG',
        'KODE_BARANG',
        'NOMOR_REGISTER',
        'LUAS',
        'TAHUN_PENGADAAN',
        'LETAK_ALAMAT',
        'HAK',
        'TANGGAL_SERTIFIKAT',
        'NO_SERTIFIKAT',
        'PENGGUNA_BARANG',
        'PENGGUNAAN',
        'ASAL_USUL',
        'HARGA',
        'KETERANGAN',
        'KOORDINAT',
        'LINK',
        'FOTO',
        'DOWNLOAD',
        'KODE_SUB_UNITS',
        'KODE_BIDANG',
        'KODE_UNITS',
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
