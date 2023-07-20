<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutTktm extends Model
{
    use HasFactory, Uuid;
    protected $table = 'out_tktm';
    protected $primaryKey = 'id_out_tktm';
    protected $fillable = [
        'tgl_upload',
        'kode_nota_dinas',
        'nominal',
        'no_ppm',
        'file_ppm',
        'no_rth_tm',
        'file_rth_tm',
        'no_rth_tk',
        'file_rth_tk',
    ];

    // public function barang_keluar()
    // {
    //     return $this->belongsTo(BarangKeluar::class, 'kode_nota_dinas', 'kode_nota_dinas');
    // }
    public function rencana_pengeluaran()
    {
        return $this->belongsTo(BarangKeluar::class, 'kode_nota_dinas', 'no_nota_dinas');
    }
}
