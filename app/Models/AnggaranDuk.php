<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranDuk extends Model
{
    use HasFactory, Uuid;
    protected $table = 'anggaran_duk';
    protected $primaryKey = 'id_anggaran_duk';
    protected $fillable = [
        'judul',
        'kategori',
        'tahun',
        'file_anggaran'
    ];
}
