<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BekkesPenugasanPeta extends Model
{
    use HasFactory, Uuid;
    protected $table = 'bekkes_penugasan_peta';
    protected $primaryKey = 'id_bekkes_pos';
    protected $fillable = [
        'id_penugasan_pos',
        'id_mas_bek',
        'jumlah'
    ];

    public function master_bekkes()
    {
        return $this->belongsTo(MasterBekkes::class, 'id_mas_bek');
    }
}
