<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Traits\UuidIdentifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InTktm extends Model
{
    use HasFactory, UuidIdentifiable;
    protected $table = 'in_tktm';
    protected $primaryKey = 'id_in_tktm';
    protected $fillable = [
        'jenis_tktm',
        'tgl_upload',
        'no_kontrak_tktm',
        'tgl_kontrak_tktm',
        'pelaksana_tktm',
        'file_kontrak_tktm',
        'nominal',
        'no_rth_tm',
        'no_rth_tk',
        'file_rth_tm',
        'file_rth_tk',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'pelaksana_tktm', 'id_vendor');
    }

    public function detail_brg_matkes_m()
    {
        return $this->hasMany(DetailBrgMatkesM::class, 'id_barang_masuk', 'id_in_tktm');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($in_tktm) {
            $in_tktm->detail_brg_matkes_m()->delete();
        });
    }
}
