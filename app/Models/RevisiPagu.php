<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisiPagu extends Model
{
    use HasFactory;
    protected $table = 'revisi_pagu';
    protected $primaryKey = 'id_revisi';
    public $incrementing = true;
    protected $fillable = [
        'id_uraian',
        'tambah',
        'kurang'
    ];

    public function uraian()
    {
        return $this->belongsTo(Uraian::class, 'id_uraian', 'id_uraian');
    }
}
