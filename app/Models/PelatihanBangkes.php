<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanBangkes extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pelatihan_bangkes';
    protected $primaryKey = 'id_pelatihan_bangkes';
    protected $fillable = [
        'id_jenis_pelatihan',
        'tgl_pelaksanaan',
        'tempat'
    ];

    public function jenis_pelatihan()
    {
        return $this->belongsTo(JenisPelatihan::class, 'id_jenis_pelatihan');
    }
}
