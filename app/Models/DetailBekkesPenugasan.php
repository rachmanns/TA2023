<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBekkesPenugasan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detail_bekkes_penugasan';
    protected $primaryKey = 'id_detail_bekkes_duk';
    protected $fillable = [
        'id_bekkes_penugasan',
        'id_mas_bek',
        'jumlah'
    ];

    public function master_bekkes()
    {
        return $this->belongsTo(MasterBekkes::class, 'id_mas_bek');
    }
}
