<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dukkes extends Model
{
    use HasFactory, Uuid;
    protected $table = 'dukkes';
    protected $primaryKey = 'id_dukkes';
    protected $fillable = [
        'nama_dukkes',
        'tempat',
        'tanggal',
        'keterangan',
        'lampiran_surat'
    ];
}
