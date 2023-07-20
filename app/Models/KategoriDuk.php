<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDuk extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kategori_duk';
    protected $primaryKey = 'id_kat_duk';
    protected $fillable = [
        'id_jenis_keg_duk',
        'nama_kategori'
    ];

    public function jenis_keg_duk()
    {
        return $this->belongsTo(JenisKegDuk::class, 'id_jenis_keg_duk');
    }
}
