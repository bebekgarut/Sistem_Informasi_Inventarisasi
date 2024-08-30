<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'arsip';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_subjek',
        'alamat',
    ];

    // Relasi ke ArsipFile
    public function files()
    {
        return $this->hasMany(ArsipFile::class, 'arsip_id');
    }
}
