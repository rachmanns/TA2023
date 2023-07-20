<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcaraKerma extends Model
{
    use HasFactory, Uuid;
    protected $table = 'acara_kerma';
    protected $primaryKey = 'id_kerma';
    protected $fillable = [
        'nama_acara',
        'id_kegiatan',
        'id_jenis_keg',
        'tempat',
        'periode',
        'tgl_pelaksanaan',
        'id_status',
        'id_keterangan',
        'file_laporan'
    ];

    public function jenis_kegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_keg', 'id_jenis_keg');
    }

    public function keterangan()
    {
        return $this->belongsTo(Keterangan::class, 'id_keterangan', 'id_keterangan');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id_status');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id_kegiatan');
    }
}
