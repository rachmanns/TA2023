<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory, Uuid;

    const ICU = 4;
    const ISOLASI = 5;

    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    protected $fillable = [
        'id_kategori',
        'nama_fasilitas'
    ];

    public function kategori_fasilitas()
    {
        return $this->belongsTo(KategoriFasilitas::class, 'id_kategori');
    }
}
