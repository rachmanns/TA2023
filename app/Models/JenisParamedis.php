<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Traits\UuidIdentifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisParamedis extends Model
{
    use HasFactory, UuidIdentifiable;
    protected $table = 'jenis_paramedis';
    protected $primaryKey = 'id_jenis_paramedis';
    protected $fillable = [
        'nama_jenis_paramedis'
    ];

    public function paramedis()
    {
        return $this->hasMany(Paramedis::class, 'id_jenis_paramedis');
    }

    public function patubel()
    {
        return $this->hasManyThrough(
            Patubel::class,
            Paramedis::class,
            'id_jenis_paramedis',
            'id_nakes',
            'id_jenis_paramedis',
            'id_paramedis'
        );
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($jenis_paramedis) { // before delete() method call this
            $jenis_paramedis->patubel()->delete();
            // do the rest of the cleanup...
        });
    }
}
