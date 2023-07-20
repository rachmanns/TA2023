<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanDuk extends Model
{
    use HasFactory, Uuid;

    const SATGAS_LN = 'satgas ln';
    const SATGAS_DN = 'satgas dn';

    protected $table = 'kegiatan_duk';
    protected $primaryKey = 'id_kegiatan_duk';
    protected $fillable = [
        'id_kat_duk',
        'jenis_kegiatan',
        'tahun_anggaran',
        'tempat',
        'tanggal',
        'file_kegiatan',
        'tgl_upload',
        'keterangan'
    ];

    public function kategori_duk()
    {
        return $this->belongsTo(KategoriDuk::class, 'id_kat_duk');
    }

    public function penugasan_satgas()
    {
        return $this->belongsTo(PenugasanSatgas::class, 'id_kat_duk', 'id_tugas');
    }
}
