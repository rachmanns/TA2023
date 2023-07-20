<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaBangkes extends Model
{
    use HasFactory, Uuid;
    protected $table = 'peserta_bangkes';
    protected $primaryKey = 'id_peserta_bangkes';
    protected $fillable = [
        'id_pelatihan_bangkes',
        'nama',
        'matra',
        'pangkat_korps',
        'nrp',
        'satuan',
        'keterangan'
    ];
}
