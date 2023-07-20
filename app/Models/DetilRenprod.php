<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class DetilRenprod extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detil_renprod';
    protected $primaryKey = 'id_detil_renprod';

    public function renprod()
    {
        return $this->belongsTo(Renprod::class, 'id_renprod', 'id_renprod');
    }

    public function progress_produksi()
    {
        return $this->hasMany(ProgressProduksi::class, 'id_detil_renprod', 'id_detil_renprod');
    }
}
