<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    use HasFactory, Uuid;
    protected $table = 'posyandu';
    protected $primaryKey = 'id_posyandu';
    protected $fillable = [
        'id_matra',
        'nama_posy',
        'alamat_posy',
        'id_kotakab',
        'latitude',
        'longitude',
        'prog_germas',
        'prog_posy',
        'hub_sektoral',
        'jml_kader_germas',
        'jml_kader_posy'
    ];

    public function matra()
    {
        return $this->belongsTo(Matra::class, 'id_matra', 'kode_matra');
    }

    public function kota_kab()
    {
        return $this->belongsTo(KotaKab::class, 'id_kotakab', 'id_kotakab');
    }
}
