<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uraian extends Model
{
    use HasFactory;
    protected $table = 'uraian';
    protected $primaryKey = 'id_uraian';
    public $incrementing = true;
    protected $guarded = [];

    public function revisi()
    {
        return $this->hasMany(RevisiPagu::class, 'id_uraian', 'id_uraian');
    }
    public function realisasi()
    {
        return $this->hasMany(Realisasi::class, 'id_uraian', 'id_uraian');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'id_parent');
    }
    public function children()
    {
        return $this->hasMany(static::class, 'id_parent');
    }
}
