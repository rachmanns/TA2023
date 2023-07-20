<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rs';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id_rs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id_angkatan');
    }

    public function kotakab()
    {
        return $this->belongsTo(KotaKab::class, 'id_kotakab', 'id_kotakab');
    }

    public function tingkat_rs()
    {
        return $this->belongsTo(TingkatRS::class, 'id_tingkat_rs', 'id_tingkat_rs');
    }

    public function bor()
    {
        return $this->hasMany(BOR::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(FasilitasRS::class, 'id_rs', 'id_rs');
    }

    public function praktek_d()
    {
        return $this->hasMany(PraktekD::class, 'id_rs', 'id_rs');
    }

    public function praktek_p()
    {
        return $this->hasMany(PraktekP::class, 'id_rs', 'id_rs');
    }
}
