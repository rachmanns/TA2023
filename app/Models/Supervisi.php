<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'supervisi';
    protected $primaryKey = 'id_supervisi';
    protected $fillable = [
        'topik',
        'tgl',
        'satuan',
        'id_kotakab',
        'file_lap_keg'
    ];

    public function panitia_supervisi()
    {
        return $this->belongsToMany(PanitiaSupervisi::class, 'panitia_supervisi_detail', 'id_supervisi', 'id_panitia_supervisi');
    }

    public function kota_kab()
    {
        return $this->belongsTo(KotaKab::class, 'id_kotakab');
    }
}
