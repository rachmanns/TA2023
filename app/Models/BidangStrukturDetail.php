<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangStrukturDetail extends Model
{
    use HasFactory;
    protected $table = 'bidang_struktur_detail';

    public function bidang()
    {
        return $this->belongsTo(BidangStruktur::class, 'bidang_id', 'id');
    }

    public function person()
    {
        return $this->belongsTo(Personil::class, 'personil_id', 'id_personil');
    }

    public function riwayat_jabatan_latest()
    {
        return $this->hasMany(RiwayatJabatan::class,'id_jabatan', 'jabatan_id')->orderBy("tmt_jabatan","desc");
    }

    public function children() {
        return $this->hasMany(BidangStrukturDetail::class, 'parent')->with('children');
    }
}
