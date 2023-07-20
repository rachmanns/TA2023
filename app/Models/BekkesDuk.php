<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BekkesDuk extends Model
{
    use HasFactory, Uuid;

    const LN = 'ln';
    const DN = 'dn';

    protected $table = 'bekkes_duk';
    protected $primaryKey = 'id_bekkes_duk';
    protected $fillable = [
        'tahun',
        'nama',
        'jumlah',
        'file_pengajuan',
        'file_disetujui',
        'keterangan',
        'cakupan',
        'satgas',
        'pers',
        'no_surat'
    ];
}
