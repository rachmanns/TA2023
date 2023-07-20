<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Korps extends Model
{
    use HasFactory;
    protected $table = 'korps';
    protected $primaryKey = 'id_korps';
    protected $fillable = [
        'kode_matra',
        'kode_korps',
        'nama_korps'
    ];

    public function matra()
    {
        return $this->belongsTo(Matra::class, 'kode_matra', 'kode_matra');
    }
}
