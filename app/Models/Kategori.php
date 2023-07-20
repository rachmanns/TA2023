<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory, Uuid;

    const AKTIF = 'AKTIF';
    const PENSIUN = 'PENSIUN';
    const UNDUR_DIRI = 'UNDUR DIRI';

    const ID_AKTIF = 1;
    const ID_PENSIUN = 2;
    const ID_UNDUR_DIRI = 3;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [
        'nama_kategori'
    ];
}
