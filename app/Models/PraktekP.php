<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraktekP extends Model
{
    use HasFactory, Uuid;
    protected $table = 'praktek_p';
    protected $primaryKey = 'id_praktek_p';
    protected $fillable = [
        'id_rs',
        'id_paramedis',
        'status',
    ];

    public function data_faskes_nakes()
    {
        return $this->belongsTo(FaskesParamedis::class, 'id_paramedis', 'id_paramedis');
    }
    public function data_bankes_nakes()
    {
        return $this->belongsTo(Paramedis::class, 'id_paramedis', 'id_paramedis');
    }
}
