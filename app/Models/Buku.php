<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory, Uuid;
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        'id_kat_buku',
        'no_buku',
        'nama_buku',
        'tahun_terbit',
        'abstraksi',
        'file_buku'
    ];

    public function kategori_buku()
    {
        return $this->belongsTo(KatBuku::class, 'id_kat_buku');
    }
}
