<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaskesParamedis extends Model
{
    use HasFactory, Uuid;
    protected $table = 'faskes_paramedis';
    protected $primaryKey = 'id_paramedis';
    protected $fillable = [
        'klasifikasi',
        'matra',
        'nama_paramedis',
        'id_jenis_paramedis',
        'pangkat',
        'no_identitas',
        'satuan_asal',
        'jabatan_struktural',
        'jabatan_fungsional',
        'keterangan',
        'jenjang',
        'jenis_ijazah'
    ];

    public function rumah_sakit()
    {
        return $this->belongsToMany(RumahSakit::class, 'praktek_p', 'id_paramedis', 'id_rs');
    }

    public function jenis_paramedis()
    {
        return $this->belongsTo(JenisParamedis::class, 'id_jenis_paramedis');
    }
    
}
