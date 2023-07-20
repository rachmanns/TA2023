<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocTenagaMedis extends Model
{
    use HasFactory, Uuid;
    protected $table = 'doc_tenaga_medis';
    protected $primaryKey = 'id_doc_tenaga_medis';
    protected $fillable = [
        'judul',
        'tahun',
        'file'
    ];
}
