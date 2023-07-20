<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $fillable = [
        // 'id_gr_es',
        'nama_jabatan'
    ];
}
