<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    use HasFactory, Uuid;
    protected $table = 'config';
    protected $primaryKey = 'id_config';
    protected $fillable = [
        'var_dsp',
        'var_rh',
        'pensiun_bintara',
        'pensiun_tamtama',
        'pensiun_perwira',
        'pensiun_pns',
        'jabatan'
    ];

    public function personil()
    {
        return $this->belongsTo(Personil::class, 'var_rh', 'id_personil');
    }
}
