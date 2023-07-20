<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class SatuanProduk extends Model
{
    use HasFactory, Uuid;
    protected $table = 'satuan_produk';
    protected $primaryKey = 'id_satuan_produk';

    public function kemasan()
    {
        return $this->hasMany(Kemasan::class, 'id_satuan_produk', 'id_satuan_produk');
    }

    public function tahap_produksi()
    {
        return $this->hasMany(TahapProduksi::class, 'id_satuan_produk', 'id_satuan_produk');
    }
}
