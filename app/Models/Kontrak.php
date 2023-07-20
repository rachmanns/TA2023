<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Traits\UuidIdentifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory, UuidIdentifiable;
    protected $table = 'kontrak';
    protected $primaryKey = 'id_kontrak';
    protected $fillable = [
        'kode_kontrak',
        'nama_kegiatan',
        'no_dipa',
        'kode_dipa',
        'tgl_dipa',
        'jumlah',
        'id_vendor',
        'nomor_kontrak',
        'tgl_kontrak',
        'masa_berlaku',
        'file_kontrak',
        'nominal_kontrak',
        'keterangan',
        'lapju_min',
        'lapju_sik',
        'dasar_pengadaan',
        'file_pendukung',
        'tgl_kegiatan_pengadaan'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'id_kontrak', 'id_kontrak');
    }

    public function in_pengadaan()
    {
        return $this->hasMany(InPengadaan::class, 'id_kontrak', 'id_kontrak');
    }

    public function detail_brg_matkes_m()
    {
        return $this->hasMany(DetailBrgMatkesM::class, 'id_barang_masuk', 'id_kontrak');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($kontrak) {
            $kontrak->detail_brg_matkes_m()->delete();
            $kontrak->in_pengadaan()->delete();
        });
    }
}
