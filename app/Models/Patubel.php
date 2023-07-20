<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patubel extends Model
{
    use HasFactory, Uuid;
    protected $table = 'patubel';
    protected $primaryKey = 'id_patubel';
    protected $fillable = [
        'tahun_ajaran',
        'ket_peserta',
        'id_nakes',
        'jenjang',
        'peminatan',
        'kampus',
        'tmt_awal',
        'tmt_akhir',
        'file_sprin',
        'peminatan2',
        'kampus2',
        'file_sprin2',
        'status',
        'tgl_lulus',
        'ipk'
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_nakes', 'id_dokter');
    }

    public function paramedis()
    {
        return $this->belongsTo(Paramedis::class, 'id_nakes', 'id_paramedis');
    }
}
