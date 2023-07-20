<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaskesFasilitasRS extends Model
{
    use HasFactory, Uuid;
    protected $table = 'faskes_fasilitas_rs';
    protected $primaryKey = 'id_fasilitas_rs';
    protected $fillable = [
        'id_rs',
        'id_fasilitas',
        'jumlah',
        'keterangan',
        'status',
    ];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function rs()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rs', 'id_rs');
    }

    public function bor()
    {
        return $this->hasOne(BOR::class, 'id_fasilitas_rs', 'id_fasilitas_rs');
    }
}
