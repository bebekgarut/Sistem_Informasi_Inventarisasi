<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipFile extends Model
{
    use HasFactory;

    protected $table = 'arsip_files';

    protected $fillable = [
        'arsip_id',
        'file_path',
    ];

    // Relasi ke Arsip
    public function arsip()
    {
        return $this->belongsTo(Arsip::class, 'arsip_id');
    }
}
