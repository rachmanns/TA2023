<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBrgMatkesM extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detail_brg_matkes_m';
    protected $primaryKey = 'id_matkes_matfas';
    protected $fillable = [
        'id_barang_masuk',
        'kode_barang',
        'kategori_barang',
        'nama_matkes',
        'jumlah',
        'harga_satuan',
        'tgl_pendataan',
        'satuan_brg',
        'id_rencana',
        'keterangan',
    ];

    public function rencana_pengeluaran()
    {
        return $this->belongsTo(RencanaPengeluaran::class, 'id_rencana', 'id_rencana');
    }

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'id_barang_masuk', 'id_kontrak');
    }

    public function hibah()
    {
        return $this->belongsTo(BaHibah::class, 'id_barang_masuk', 'id_ba_hibah');
    }

    public function tktm()
    {
        return $this->belongsTo(InTktm::class, 'id_barang_masuk', 'id_in_tktm');
    }

    public function detail_brg_matkes_d()
    {
        return $this->hasMany(DetailBrgMatkesD::class, 'id_matkes_matfas', 'id_matkes_matfas');
    }

    public function kategori_brg()
    {
        return $this->belongsTo(KategoriBrg::class, 'kategori_barang', 'id_kategori');
    }

    public function brg_out()
    {
        return $this->hasManyThrough(
            BrgOut::class,
            DetailBrgMatkesD::class,
            'id_matkes_matfas',
            'id_matkes_dobek',
            'id_matkes_matfas',
            'id_matkes_dobek',
        );
    }
}
