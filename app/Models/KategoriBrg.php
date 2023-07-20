<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class KategoriBrg extends Model
{
    use HasFactory, Uuid;
    protected $table = 'kategori_brg';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori',
    ];
}
