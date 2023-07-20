<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutHibah extends Model
{
    use HasFactory, Uuid;
    protected $table = 'out_hibah';
    protected $primaryKey = 'id_out_hibah';
    protected $fillable = [
        'tgl_upload',
        'kode_nota_dinas',
        'nominal',
        'no_rth_hibah',
        'file_rth_hibah',
    ];

    // public function barang_keluar()
    // {
    //     return $this->belongsTo(BarangKeluar::class, 'kode_nota_dinas', 'kode_nota_dinas');
    // }
    public function rencana_pengeluaran()
    {
        return $this->belongsTo(RencanaPengeluaran::class, 'kode_nota_dinas', 'no_nota_dinas');
    }
}
