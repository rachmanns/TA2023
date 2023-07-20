<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory, Uuid;
    protected $table = 'keluarga';
    protected $primaryKey = 'id_keluarga';
    protected $fillable = [
        'id_personil',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'hubungan'
    ];
}
