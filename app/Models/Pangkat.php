<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pangkat';
    protected $primaryKey = 'id_pangkat';
    protected $fillable = [
        'kode_matra',
        'nama_pangkat',
        'masa_kenkat',
        'jenis_pangkat',
        'next_pangkat',
        'usia_pensiun'
    ];

    public function personil()
    {
        return $this->hasMany(Personil::class, 'id_pangkat_terakhir', 'id_pangkat');
    }

    public function children()
    {
        return $this->hasOne(Pangkat::class, 'next_pangkat', 'id_pangkat');
    }

    public function parent()
    {
        return $this->belongsTo(Pangkat::class, 'next_pangkat', 'id_pangkat');
    }
}
