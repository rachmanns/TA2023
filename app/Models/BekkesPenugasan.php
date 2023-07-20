<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BekkesPenugasan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'bekkes_penugasan';
    protected $primaryKey = 'id_bekkes_penugasan';
    protected $fillable = [
        'nama_satgas',
        'operasi',
        'tgl_berangkat',
        'tgl_kembali',
        'jumlah_pers',
        'endemik',
        'keterangan',
        'jenis_satgas'
    ];
}
