<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipePos extends Model
{
    use HasFactory, Uuid;
    protected $table = 'tipe_pos';
    protected $primaryKey = 'id_tipe_pos';
    protected $fillable = [
        'image',
        'tipe'
    ];
}
