<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'regulasi';
    protected $primaryKey = 'id_regulasi';
    protected $fillable = ['id_bidang', 'nama_regulasi', 'file', 'id_kat_buku'];

    public function kat_buku()
    {
        return $this->belongsTo(KatBuku::class, 'id_kat_buku');
    }
}
