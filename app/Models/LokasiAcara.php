<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiAcara extends Model
{
    use HasFactory, Uuid;
    protected $table = 'lokasi_acara';
    protected $primaryKey = 'id_lokasi';
    protected $fillable = [
        'id_kerma',
        'nama_tempat',
        'latitude',
        'longitude'
    ];
}
