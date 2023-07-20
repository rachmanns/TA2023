<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnggota extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detail_anggota';
    protected $primaryKey = 'id_detail_anggota';
    protected $fillable = [
        'id_penugasan_pos',
        'id_data_kegiatan_duk'
    ];

    public function data_kegiatan_duk()
    {
        return $this->belongsTo(DataKegiatanDuk::class, 'id_data_kegiatan_duk');
    }
}
