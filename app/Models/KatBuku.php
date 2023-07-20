<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KatBuku extends Model
{
    use HasFactory, Uuid;

    const PERPANG = 1;
    const JUKGAR = 2;
    const JUKNIS = 3;
    const NASKAH_SEMENTARA = 4;

    protected $table = 'kat_buku';
    protected $primaryKey = 'id_kat_buku';
    protected $fillable = [
        'nama_kat_buku'
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_kat_buku');
    }
}
