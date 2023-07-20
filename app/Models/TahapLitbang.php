<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapLitbang extends Model
{
    use HasFactory;
    protected $table = 'tahap_litbang';
    protected $primaryKey = 'id_tahap';
}
