<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahasa extends Model
{
    use HasFactory, Uuid;
    protected $table = 'bahasa';
    protected $primaryKey = 'id_bahasa';
    protected $fillable = [
        'id_personil',
        'kompetensi',
        'jenis',
        'bahasa'
    ];
}
