<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDokter extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kategori_dokter';
    protected $primaryKey = 'id_kategori_dokter';
    protected $fillable = [
        'nama_kategori'
    ];

    public function dokter()
    {
        return $this->hasManyThrough(
            SpesialisDokter::class,
            JenisSpesialis::class,
            'id_kategori_dokter',
            'id_spesialis',
            'id_kategori_dokter',
            'id_spesialis'
        );
    }
}
