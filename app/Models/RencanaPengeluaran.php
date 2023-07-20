<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaPengeluaran extends Model
{
    use HasFactory, Uuid;
    protected $table = 'rencana_pengeluaran';
    protected $primaryKey = 'id_rencana';
    protected $fillable = [
        'penerima',
        'tujuan_penggunaan',
        'id_barang_masuk',
        'tgl_keluar',
        'no_nota_dinas',
        'file_nota_dinas',
        'no_spb',
        'file_spb',
        'no_sprindis',
        'file_sprindis',
        'jenis_pengeluaran',
    ];

    public function detail_brg_matkes_m()
    {
        return $this->hasMany(DetailBrgMatkesM::class, 'id_rencana', 'id_rencana');
    }

    public function brg_out()
    {
        return $this->hasMany(BrgOut::class, 'id_rencana', 'id_rencana');
    }
}
