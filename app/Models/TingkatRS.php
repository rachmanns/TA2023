<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatRS extends Model
{
    use HasFactory, Uuid;
    protected $table = 'tingkat_rs';
    protected $primaryKey = 'id_tingkat_rs';
    protected $fillable = [
        'nama_tingkat_rs'
    ];
}
