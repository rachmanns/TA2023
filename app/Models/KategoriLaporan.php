<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLaporan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kategori_laporan';
    protected $primaryKey = 'id_kat_lap';
    protected $fillable = [
        'nama_kat_lap',
    ];
}
