<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidangs';

    protected $fillable = [
        'KODE_BIDANG',
        'NAMA_BIDANG',
    ];

    protected $primaryKey = 'KODE_BIDANG';
    public $incrementing = false;
    protected $keyType = 'integer';

    public function units()
    {
        return $this->hasMany(Unit::class, 'KODE_BIDANG', 'KODE_BIDANG');
    }
}
