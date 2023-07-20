<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanSatgas extends Model
{
    use HasFactory, Uuid;
    protected $table = 'penugasan_satgas';
    protected $primaryKey = 'id_tugas';
    protected $fillable = [
        'id_satgas_ops',
        'id_pos',
        'id_batalyon',
        'nama_satgas',
        'nama_batalyon',
        'tahun_anggaran',
        'arrv_date',
        'dept_date',
        'nama_pers',
        'no_telp',
        'jml_pers',
        'nota_dinas',
        'status_dist'
    ];

    public function satgas_ops()
    {
        return $this->belongsTo(SatgasOps::class, 'id_satgas_ops', 'id_satgas_ops');
    }

    public function pos_satgas()
    {
        return $this->belongsToMany(PosSatgas::class, 'penugasan_pos', 'id_tugas', 'id_pos');
    }

    public function data_kegiatan_duk()
    {
        return $this->hasManyThrough(
            DataKegiatanDuk::class,
            KegiatanDuk::class,
            'id_kat_duk', // Foreign key on the environments table...
            'id_kegiatan_duk', // Foreign key on the deployments table...
            'id_tugas', // Local key on the projects table...
            'id_kegiatan_duk' // Local key on the environments table...
        );
    }
}
