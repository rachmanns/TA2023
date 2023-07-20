<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKegiatanDuk extends Model
{
    use HasFactory, Uuid;
    protected $table = 'data_kegiatan_duk';
    protected $primaryKey = 'id_data_kegiatan_duk';
    protected $fillable = [
        'id_kegiatan_duk',
        'no_urt',
        'no_tes',
        'nama',
        'kelas',
        'prodi',
        'jenis_kelamin',
        'tb_bb',
        'imt',
        'tensi_nadi',
        'peny_dalam',
        'usg',
        'obgyn',
        'jantung',
        'ergometri',
        'paru',
        'ro',
        'lab',
        'tht',
        'kulit',
        'bedah',
        'atas',
        'bawah',
        'pendengaran_keseimbangan',
        'mata',
        'gigi',
        'jiwa',
        'hasil_um',
        'hasil_wa',
        'ket_nilai',
        'ket_hasil',
        'kesimpulan',
        'ekg',
        'pangkat',
        'jabatan',
        'nrp',
        'isPlotted'
    ];
}
