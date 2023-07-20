<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RSPos extends Model
{
    use HasFactory, Uuid;
    protected $table = 'rs_pos';
    protected $primaryKey = 'id_rs_pos';
    protected $fillable = [
        'id_rs_pem_swas',
        'id_pos',
        'tipe',
        'jarak',
        'evakuasi'
    ];

    public function rs_pemda_swasta()
    {
        return $this->belongsTo(RSPemdaSwasta::class, 'id_rs_pem_swas');
    }

    public function rs_militer()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rs_pem_swas');
    }
}
