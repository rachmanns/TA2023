<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilBahanRenprod extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detil_bahan_renprod';
    protected $primaryKey = 'id_detil_bahan';

    public function bahan_produksi()
    {
        return $this->belongsTo(BahanProduksi::class, 'id_bahan_produksi', 'id_bahan_produksi');
    }
}
