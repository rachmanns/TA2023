<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory, Uuid;
    protected $table = 'hutang';
    protected $primaryKey = 'id_hutang';
    protected $fillable = [
        'batalyon',
        'operasi',
        'jml_pers',
        'indeks',
        'jml_tagihan',
        'jml_bayar',
        'tgl_hutang',
        'tgl_lunas',
        'keterangan'
    ];

    public function cicilan()
    {
        return $this->hasMany(Cicilan::class, 'id_hutang');
    }

    public function latest_cicilan()
    {
        return $this->hasOne(Cicilan::class, 'id_hutang')->latest();
    }
}
