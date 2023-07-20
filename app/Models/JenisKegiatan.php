<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory, Uuid;

    protected $table = 'jenis_kegiatan';
    protected $primaryKey = 'id_jenis_keg';
    protected $fillable = ['jenis_keg',  'kategori_keg'];

    public function acara_kerma()
    {
        return $this->hasMany(AcaraKerma::class, 'id_jenis_keg');
    }
}
