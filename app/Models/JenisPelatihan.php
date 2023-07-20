<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelatihan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'jenis_pelatihan';
    protected $primaryKey = 'id_jenis_pelatihan';
    protected $fillable = [
        'nama_pelatihan'
    ];

    public function peserta_bangkes()
    {
        return $this->hasManyThrough(
            PesertaBangkes::class,
            PelatihanBangkes::class,
            'id_jenis_pelatihan',
            'id_pelatihan_bangkes',
            'id_jenis_pelatihan',
            'id_pelatihan_bangkes'
        );
    }
}
