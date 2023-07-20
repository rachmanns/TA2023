<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pelaporan';
    protected $primaryKey = 'id_pelaporan';
    protected $fillable = [
        'periode_laporan',
        'tgl_upload',
        'id_kategori',
        'file'
    ];

    public function kategori_laporan()
    {
        return $this->belongsTo(KategoriLaporan::class, 'id_kategori', 'id_kat_lap');
    }
}
