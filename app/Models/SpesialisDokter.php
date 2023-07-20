<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesialisDokter extends Model
{
    use HasFactory, Uuid;
    protected $table = 'spesialis_dokter';
    protected $primaryKey = 'id_spesialis_dokter';
    protected $fillable = [
        'id_spesialis',
        'id_dokter'
    ];
}
