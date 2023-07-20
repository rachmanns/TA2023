<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBBM extends Model
{
    use HasFactory, Uuid;
    protected $table = 'jenis_bbm';
    protected $primaryKey = 'id_jenis_bbm';
}
