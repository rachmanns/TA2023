<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory, Uuid;
    protected $table = 'penyakit';
    protected $primaryKey = 'id_penyakit';
    protected $fillable = [
        'nama_penyakit'
    ];

}
