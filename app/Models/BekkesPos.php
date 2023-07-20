<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BekkesPos extends Model
{
    use HasFactory, Uuid;
    protected $table = 'bekkes_pos';
    protected $primaryKey = 'id_bekkes_pos';
    protected $fillable = [
        'id_mas_bek',
        'id_pos_satgas',
        'jumlah'
    ];
}
