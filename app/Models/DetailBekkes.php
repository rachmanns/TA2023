<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBekkes extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detail_bekkes';
    protected $primaryKey = 'id_detail_bekkes';
    protected $fillable = [
        // 'id_mas_bek',
        'id_kategori_brg',
        'id_data_bekkes',
        'jenis_brg',
        'nama_brg',
        'satuan',
        'jml',
        'keterangan'
    ];

    public function kategori_brg()
    {
        return $this->belongsTo(KategoriBrg::class, 'id_kategori_brg', 'id_kategori');
    }
}
