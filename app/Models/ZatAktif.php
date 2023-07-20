<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class ZatAktif extends Model
{
    use HasFactory, Uuid;
    protected $table = 'zat_aktif';
    protected $primaryKey = 'id_zat_aktif';

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
