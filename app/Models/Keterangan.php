<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'keterangan';
    protected $primaryKey = 'id_keterangan';
    protected $fillable = ['keterangan'];
}
