<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory, Uuid;
    const DALAM_NEGERI = 'dn';
    const LUAR_NEGERI = 'ln';
    protected $table = 'penugasan';
    protected $primaryKey = 'id_penugasan';
    protected $fillable = [
        'id_personil',
        'tugas',
        'tahun',
        'jenis',
        'lokasi'
    ];
}
