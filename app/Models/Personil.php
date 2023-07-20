<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
    use HasFactory, Uuid;
    protected $table = 'personil';
    protected $primaryKey = 'id_personil';
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'nrp',
        'nik',
        'npwp',
        'no_asabri',
        'no_telp',
        'no_kk',
        'no_bpjs',
        'no_kpis',
        'email',
        'tempat_lahir',
        'tgl_lahir',
        'agama',
        'suku',
        'jenis_rambut',
        'warna_kulit',
        'tinggi_badan',
        'berat_badan',
        'gol_darah',
        'foto',
        'status_pernikahan',
        'no_surat_nikah',
        'tgl_pernikahan',
        'tmt_tni',
        'tmt_perwira',
        'tmt_bintara',
        'tmt_tamtama',
        'psikologi',
        'jasmani',
        'dapen',
        'kesehatan',
        'grade',
        'eselon',
        'nama_kesatuan',
        'nama_jabatan_terakhir',
        'tmt_jabatan_terakhir',
        'nama_pangkat_terakhir',
        'tmt_pangkat_terakhir',
        'kode_korps',
        'alamat',
        'id_pangkat_terakhir',
        'id_kategori',

        'sumber_masuk'
    ];

    public function korps()
    {
        return $this->belongsTo(Korps::class, 'kode_korps', 'kode_korps');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat_terakhir', 'id_pangkat');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function event_buku()
    {
        return $this->belongsToMany(EventBuku::class, 'panitia_buku', 'id_personil', 'id_event_buku');
    }
}
