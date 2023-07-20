<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanPos extends Model
{
    use HasFactory, Uuid;
    protected $table = 'penugasan_pos';
    protected $primaryKey = 'id_penugasan_pos';
    protected $fillable = [
        'id_tugas',
        'id_pos',
        'nama_ketua',
        'no_telp',
        'jml_personil'
    ];

    public function pos_satgas()
    {
        return $this->belongsTo(PosSatgas::class, 'id_pos');
    }

    public function penugasan_satgas()
    {
        return $this->belongsTo(PenugasanSatgas::class, 'id_tugas');
    }

    public function master_bekkes()
    {
        return $this->belongsToMany(MasterBekkes::class, 'bekkes_penugasan_peta', 'id_penugasan_pos', 'id_mas_bek')->withPivot('jumlah');
    }
}
