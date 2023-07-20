<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKategori extends Model
{
    use HasFactory, Uuid;
    protected $table = 'riwayat_kategori';
    protected $primaryKey = 'id_riwayat_kategori';
    protected $fillable = [
        'id_kategori',
        'id_personil',
        'tmt_kategori'
    ];
}
