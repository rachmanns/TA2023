<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matra extends Model
{
    use HasFactory;
    protected $table = 'matra';
    protected $primaryKey = 'id_matra';
    protected $fillable = ['kode_matra', 'nama_matra'];
}
