<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaJasa extends Model
{
    use HasFactory, Uuid;
    protected $table = 'tanda_jasa';
    protected $primaryKey = 'id_jasa';
    protected $fillable = [
        'nama_jasa',
        'keterangan'
    ];
}
