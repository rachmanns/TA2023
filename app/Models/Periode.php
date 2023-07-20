<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory, Uuid;
    protected $table = 'periode';
    protected $primaryKey = 'id_periode';
    protected $fillable = [
        'nama_periode'
    ];
}
