<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Traits\UuidIdentifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class BaHibah extends Model
{
    use HasFactory, UuidIdentifiable;
    // use HasFactory, Uuid;
    protected $table = 'ba_hibah';
    protected $primaryKey = 'id_ba_hibah';
    protected $fillable = [
        'kode_ba_hibah',
        'no_ba_hibah',
        'file_ba_hibah',
        'tgl_ba_hibah',
        'id_vendor',
        'nominal',
        'no_app_hibah',
        'file_app_hibah',
        'tgl_app_hibah',
        'tgl_last_upload_doc',
    ];

    protected $dates = [
        'tgl_ba_hibah'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }

    public function detail_brg_matkes_m()
    {
        return $this->hasMany(DetailBrgMatkesM::class, 'id_barang_masuk', 'id_ba_hibah');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($ba_hibah) {
            $ba_hibah->detail_brg_matkes_m()->delete();
        });
    }
}
