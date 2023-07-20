<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory, Uuid;
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_nota_dinas';
    protected $fillable = [
        'jenis_kegiatan',
        'kode_nota_dinas',
        'no_nota_dinas',
        'file_nota_dinas',
        'no_spb',
        'file_spb',
        'nominal',
    ];
}
