<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class BOR extends Model
{
    use Uuid;
    protected $table = 'bor';
    protected $primaryKey = 'id_bor';
    protected $fillable = [
        'id_fasilitas_rs',
        'tgl_update',
        'tersedia',
        'terpakai'
    ];

    public function rumahsakit()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rs', 'id_rs');
    }

    public function fasilitas_rs()
    {
        return $this->belongsTo(FasilitasRS::class, 'id_fasilitas_rs', 'id_fasilitas_rs');
    }
}
