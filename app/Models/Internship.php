<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory, Uuid;
    protected $table = 'internship';
    protected $primaryKey = 'id_internship';
    protected $fillable = [
        'matra',
        'nama',
        'pangkat',
        'korps',
        'nrp',
        'jabatan',
        'kesatuan',
        'wahana',
        'tgl_mulai',
        'tgl_selesai'
    ];
}
