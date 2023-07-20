<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geografis extends Model
{
    use HasFactory, Uuid;
    protected $table = 'geografis';
    protected $primaryKey = 'id_geografis';
    protected $fillable = [
        'jenis_geografis'
    ];
}
