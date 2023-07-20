<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesatuan extends Model
{
    use HasFactory;
    protected $table = 'kesatuan';
    protected $primaryKey = 'id_kesatuan';
    protected $fillable = ['kode_matra', 'kode_kesatuan', 'nama_kesatuan'];
}
