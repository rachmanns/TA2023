<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InPengadaan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'in_pengadaan';
    protected $primaryKey = 'id_in_pengadaan';
    protected $fillable = [
        'tgl_upload',
        'id_kontrak',
        'nominal',
        'no_rth',
        'file_rth',
    ];

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'id_kontrak', 'id_kontrak');
    }
}
