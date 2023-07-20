<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Produk extends Model
{
    use HasFactory, Uuid;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    public function kemasan()
    {
        return $this->hasMany(Kemasan::class, 'id_produk', 'id_produk');
    }

    public function zat_aktif()
    {
        return $this->hasMany(ZatAktif::class, 'id_produk', 'id_produk');
    }
}
