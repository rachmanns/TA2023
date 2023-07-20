<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batalyon extends Model
{
    use HasFactory, Uuid;
    protected $table = 'batalyon';
    protected $primaryKey = 'id_batalyon';
    protected $fillable = [
        'nama_batalyon'
    ];
}
