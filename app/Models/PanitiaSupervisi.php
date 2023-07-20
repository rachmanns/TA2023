<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaSupervisi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'panitia_supervisi';
    protected $primaryKey = 'id_panitia_supervisi';
    protected $fillable = [
        'nama',
        'nrp',
        'pangkat',
        'jabatan',
        'satuan',
        'status'
    ];
}
