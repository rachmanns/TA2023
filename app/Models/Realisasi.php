<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;
    protected $table = 'realisasi';
    protected $primaryKey = 'id_realisasi';
    public $incrementing = true;
    protected $guarded = [];
    protected $dates = [
        'tgl_realisasi'
    ];

    public function uraian()
    {
        return $this->belongsTo(Uraian::class, 'id_uraian', 'id_uraian');
    }
}
