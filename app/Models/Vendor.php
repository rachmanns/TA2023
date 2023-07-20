<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory, Uuid;
    protected $table = 'vendor';
    protected $primaryKey = 'id_vendor';
    protected $fillable = [
        'nama_vendor',
        'alamat',
        'direktur',
        'npwp',
    ];
}
