<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBekkes extends Model
{
    use HasFactory, Uuid;

    protected $table = 'data_bekkes';
    protected $primaryKey = 'id_data_bekkes';
    protected $fillable = [
        'id_mas_bek',
        'tahun_anggaran',
        'jenis_tujuan',
        'foto'
    ];

    public function master_bekkes()
    {
        return $this->belongsTo(MasterBekkes::class, 'id_mas_bek', 'id_mas_bek');
    }
}
