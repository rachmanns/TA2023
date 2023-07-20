<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $table = 'bidang';
    protected $fillable = [
        'kode_bidang',
        'nama_bidang'
    ];

    public function uraian()
    {
        return $this->hasMany(Uraian::class, 'kode_bidang', 'kode_bidang');
    }

    public function realisasi()
    {
        return $this->hasManyThrough(
            Realisasi::class,
            Uraian::class,
            'kode_bidang', // Foreign key on the environments table...
            'id_uraian', // Foreign key on the deployments table...
            'kode_bidang', // Local key on the projects table...
            'id_uraian' // Local key on the environments table...
        );
    }
}
