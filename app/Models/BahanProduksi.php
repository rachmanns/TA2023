<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanProduksi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'bahan_produksi';
    protected $primaryKey = 'id_bahan_produksi';

    public function kategori()
    {
        return $this->belongsTo(KategoriBahanProduksi::class, 'id_kategori', 'id_kategori');
    }

    public function detil_bahan_renprod()
    {
        return $this->hasMany(DetilBahanRenprod::class, 'id_bahan_produksi', 'id_bahan_produksi');
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiBahanProduksi::class, 'id_bahan_produksi', 'id_bahan_produksi');
    }
}
