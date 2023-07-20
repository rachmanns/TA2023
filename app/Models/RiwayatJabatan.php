<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'riwayat_jabatan';
    protected $primaryKey = 'id_riwayat_jabatan';
    protected $fillable = [
        'id_jabatan',
        'id_personil',
        'tmt_jabatan',
        'no_skep_jabatan',
        'tgl_skep_jabatan',
        'no_sprin_jabatan',
        'tgl_sprin_jabatan'
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
    
    public function person()
    {
        return $this->belongsTo(Personil::class, 'id_personil', 'id_personil');
    }
}
