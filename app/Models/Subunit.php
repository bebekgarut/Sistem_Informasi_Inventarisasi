<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subunit extends Model
{
    use HasFactory;

    protected $table = 'subunits';

    protected $fillable = [
        'KODE_SUB_UNITS',
        'NAMA_SUB_UNITS',
        'KODE_BIDANG',
        'KODE_UNITS',
    ];

    protected $primaryKey = 'KODE_SUB_UNITS';
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
}
