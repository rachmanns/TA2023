<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSatgas extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pos_satgas';
    protected $primaryKey = 'id_pos';
    protected $fillable = [
        'id_satgas_ops',
        'nama_pos',
        'latitude',
        'longitude',
        'id_geografis',
        'status_endemik',
        'pendapatan',
        'kepadatan',
        'ekonomi',
        'sosial',
        'budaya',
        'suku',
        'ideologi',
        'keterangan',
        'tipe'
    ];

    public function satgas_ops()
    {
        return $this->belongsTo(SatgasOps::class, 'id_satgas_ops');
    }

    public function geografis()
    {
        return $this->belongsTo(Geografis::class, 'id_geografis');
    }
}
