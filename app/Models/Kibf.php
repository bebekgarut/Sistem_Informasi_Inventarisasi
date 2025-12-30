<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kibf extends Model
{
    use HasFactory;

    protected $table = 'kibfs';

    protected $fillable = [
        'id',
        'kode_barang',
        'nama_barang',
        'nibar',
        'nomor_register',
        'spesifikasi_nama_barang',
        'spesifikasi_lainnya',
        'lokasi',
        'jumlah',
        'satuan',
        'harga_satuan_perolehan',
        'nilai_perolehan',
        'cara_perolehan',
        'tanggal_perolehan',
        'status_penggunaan',
        'keterangan',
        'PENGGUNA_BARANG',
        'FOTO',
        'DOWNLOAD',
        'KODE_BIDANG',
        'KODE_UNITS',
        'KODE_SUB_UNITS',
        'KODE_UPB',
    ];
    protected $primaryKey = 'id';

    // Relasi
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
