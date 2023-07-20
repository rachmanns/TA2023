<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraktekD extends Model
{
    use HasFactory, Uuid;
    protected $table = 'praktek_d';
    protected $primaryKey = 'id_praktek_d';
    protected $fillable = [
        'id_rs',
        'id_dokter',
        'status',
    ];

    public function data_faskes_nakes()
    {
        return $this->belongsTo(FaskesNakes::class, 'id_dokter', 'id_dokter');
    }
    public function data_bankes_nakes()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
}
