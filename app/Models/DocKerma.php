<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocKerma extends Model
{
    use HasFactory, Uuid;
    protected $table = 'doc_kerma';
    protected $primaryKey = 'id_doc_kerma';
    protected $fillable = [
        'id_parent_doc',
        'jenis_doc_kerma',
        'pihak',
        'lembaga',
        'no_doc',
        'tgl_terbit',
        'tgl_berakhir',
        'status_perjanjian',
        'desc',
        'keterangan',
        'file_doc',
    ];

    public function parent()
    {
        return $this->belongsTo(static::class, 'id_parent_doc');
    }
}
