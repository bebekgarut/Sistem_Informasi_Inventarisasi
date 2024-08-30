<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'KODE_UNITS',
        'NAMA_UNITS',
        'KODE_BIDANG',
    ];

    protected $primaryKey = 'KODE_UNITS';
    public $incrementing = false;
    protected $keyType = 'integer';

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'KODE_BIDANG', 'KODE_BIDANG');
    }

    public function subunits()
    {
        return $this->hasMany(Subunit::class, 'KODE_UNITS', 'KODE_UNITS');
    }
}
