<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBahanProduksi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kategori_bahan_produksi';
    protected $primaryKey = 'id_kategori';

    public function bahan_produksi()
    {
        return $this->hasMany(BahanProduksi::class, 'id_kategori', 'id_kategori');
    }
}
