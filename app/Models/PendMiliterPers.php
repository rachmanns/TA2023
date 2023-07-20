<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendMiliterPers extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pend_militer_pers';
    protected $primaryKey = 'id_pend_militer_pers';
    protected $fillable = [
        'id_personil',
        'kategori_pendidikan',
        'tahun_lulus',
        'nama_sekolah',
        'kriteria_tingkat'
    ];
}
