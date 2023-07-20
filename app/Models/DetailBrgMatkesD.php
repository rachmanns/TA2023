<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class DetailBrgMatkesD extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detail_brg_matkes_d';
    protected $primaryKey = 'id_matkes_dobek';
    protected $fillable = [
        'id_matkes_matfas',
        'id_gudang',
        'exp_date',
    ];

    public function brg_out()
    {
        return $this->hasMany(BrgOut::class, 'id_matkes_dobek', 'id_matkes_dobek');
    }

    public function detail_brg_matkes_m()
    {
        return $this->belongsTo(DetailBrgMatkesM::class, 'id_matkes_matfas', 'id_matkes_matfas');
    }
}
