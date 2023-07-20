<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSpesialis extends Model
{
    use HasFactory, Uuid;
    protected $table = 'jenis_spesialis';
    protected $primaryKey = 'id_spesialis';
    protected $fillable = [
        'id_kategori_dokter',
        'nama_spesialis'
    ];

    public function kategori_dokter()
    {
        return $this->belongsTo(KategoriDokter::class, 'id_kategori_dokter');
    }
}
