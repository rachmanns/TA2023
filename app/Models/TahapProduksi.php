<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class TahapProduksi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'tahap_produksi';
    protected $primaryKey = 'id_tahap';

    public function satuan_produk()
    {
        return $this->belongsTo(SatuanProduk::class, 'id_satuan_produk', 'id_satuan_produk');
    }
}
