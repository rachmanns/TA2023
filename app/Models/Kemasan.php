<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Kemasan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kemasan';
    protected $primaryKey = 'id_kemasan';

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function satuan_produk()
    {
        return $this->belongsTo(SatuanProduk::class, 'id_satuan_produk', 'id_satuan_produk');
    }

    public function detil_rko()
    {
        return $this->hasMany(DetilRKO::class, 'id_kemasan', 'id_kemasan');
    }

    public function renprod()
    {
        return $this->hasMany(Renprod::class, 'id_kemasan', 'id_kemasan');
    }
}
