<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaraBakti extends Model
{
    use HasFactory, Uuid;
    protected $table = 'acara_bakti';
    protected $primaryKey = 'id_bakti';
    protected $fillable = [
        'nama_acara',
        'id_jenis_keg',
        'tempat',
        'periode',
        'sasaran',
        'capaian',
        'tgl_pelaksanaan',
        'id_keterangan',
        'file_laporan'
    ];

    public function jenis_kegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_keg', 'id_jenis_keg');
    }
}
