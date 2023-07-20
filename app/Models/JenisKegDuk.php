<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegDuk extends Model
{
    use HasFactory, Uuid;

    const WERVING = 1;
    const SATGAS_LN = 2;
    const PENDIDIKAN = 3;

    protected $table = 'jenis_keg_duk';
    protected $primaryKey = 'id_jenis_keg_duk';
    protected $fillable = [
        'nama_jenis'
    ];
}
