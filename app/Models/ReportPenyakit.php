<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPenyakit extends Model
{
    use HasFactory;
    protected $table = 'report_penyakit';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_angkatan',
        'id_penyakit',
        'tahun',
        'status',
        'sebelumnya',
        'baru',
        'berobat',
        'sembuh',
        'meninggal',
        'id_periode'
    ];

    public function angkatan(){
        return $this->belongsTo(Angkatan::class,'id_angkatan','id_angkatan'); 
    }
    public function penyakit(){
        return $this->belongsTo(Penyakit::class,'id_penyakit','id_penyakit'); 
    }
}
