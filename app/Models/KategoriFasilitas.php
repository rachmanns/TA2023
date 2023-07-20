<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitas extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kategori_fasilitas';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori'
    ];

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'id_kategori', 'id_kategori');
    }
}
