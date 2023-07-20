<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory, Uuid;
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    protected $fillable = [
        'klasifikasi',
        'matra',
        'nama_dokter',
        'pangkat_korps',
        'no_identitas',
        'satuan_asal',
        'jabatan_struktural',
        'jabatan_fungsional',
        'keterangan',
        'jenjang'
    ];

    public function rumah_sakit()
    {
        return $this->belongsToMany(RumahSakit::class, 'praktek_d', 'id_dokter', 'id_rs');
    }

    public function jenis_spesialis()
    {
        return $this->belongsToMany(JenisSpesialis::class, 'spesialis_dokter', 'id_dokter', 'id_spesialis');
    }
}
