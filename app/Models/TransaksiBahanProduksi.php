<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiBahanProduksi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'transaksi_bahan_produksi';
    protected $primaryKey = 'id_transaksi';
}
