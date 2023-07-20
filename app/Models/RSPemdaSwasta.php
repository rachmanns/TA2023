<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSPemdaSwasta extends Model
{
    use HasFactory, Uuid;
    protected $table = 'rs_pemda_swasta';
    protected $primaryKey = 'id_rs_pem_swas';
    protected $fillable = [
        'nama_rs',
        'kategori',
        'latitude',
        'longitude'
    ];
}
