<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UPB extends Model
{
    use HasFactory;

    protected $table = 'upbs';

    protected $fillable = [
        'KODE_UPB',
        'NAMA_UPB',
        'KODE_BIDANG',
        'KODE_UNITS',
        'KODE_SUB_UNITS',
    ];

    protected $primaryKey = 'KODE_UPB';
    public $incrementing = false;
    protected $keyType = 'integer';

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
}
