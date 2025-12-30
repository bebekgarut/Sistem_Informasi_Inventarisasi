<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kibd extends Model
{
    use HasFactory;

    protected $table = 'kibds';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'nibar',
        'nomor_register',
        'spesifikasi_nama_barang',
        'spesifkasi_lainnya',
        'nomor_ruas_jalan',
        'nomor_ruas_jembatan',
        'nomor_ruas_jaringan_irigasi',
        'lokasi',
        'titik_koordinat',
        'status_kepemilikan_tanah',
        'jumlah',
        'satuan',
        'harga_satuan_perolehan',
        'cara_perolehan',
        'tanggal_perolehan',
        'nilai_perolehan',
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
