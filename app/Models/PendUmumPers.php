<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendUmumPers extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pend_umum_pers';
    protected $primaryKey = 'id_pend_umum_pers';
    protected $fillable = [
        'id_personil',
        'id_pend_umum',
        'nama_sekolah',
        'tahun_lulus'
    ];

    public function pendidikan_umum()
    {
        return $this->belongsTo(PendidikanUmum::class, 'id_pend_umum', 'id_pend_umum');
    }
}
