<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endemik extends Model
{
    use HasFactory, Uuid;
    protected $table = 'endemik';
    protected $primaryKey = 'id_endemik';
    protected $fillable = [
        'nama_endemik'
    ];
}
