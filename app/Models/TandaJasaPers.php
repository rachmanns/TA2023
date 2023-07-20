<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaJasaPers extends Model
{
    use HasFactory, Uuid;
    protected $table = 'tanda_jasa_pers';
    protected $primaryKey = 'id_jasa_pers';
    protected $fillable = [
        'id_personil',
        'id_jasa',
        'tahun'
    ];

    public function tanda_jasa()
    {
        return $this->belongsTo(TandaJasa::class, 'id_jasa', 'id_jasa');
    }
}
