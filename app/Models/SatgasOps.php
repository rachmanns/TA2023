<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatgasOps extends Model
{
    use HasFactory, Uuid;
    protected $table = 'satgas_ops';
    protected $primaryKey = 'id_satgas_ops';
    protected $fillable = [
        'nama_kat_satgas',
        'jenis_satgas',
        'keterangan'
    ];

    public function penugasan_satgas()
    {
        return $this->hasMany(SatgasOps::class, 'id_satgas_ops', 'id_satgas_ops');
    }

    public function pos_satgas()
    {
        return $this->hasMany(PosSatgas::class, 'id_satgas_ops', 'id_satgas_ops');
    }
}
