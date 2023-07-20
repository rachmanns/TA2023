<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBuku extends Model
{
    use HasFactory, Uuid;
    protected $table = 'event_buku';
    protected $primaryKey = 'id_event_buku';
    protected $fillable = [
        'id_kotakab',
        'id_buku',
        'tgl_event',
        'satuan',
        'jml_peserta',
        'file_lap_keg',
        'status_keg'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function kota_kab()
    {
        return $this->belongsTo(KotaKab::class, 'id_kotakab');
    }

    public function personil()
    {
        return $this->belongsToMany(Personil::class, 'panitia_buku', 'id_event_buku', 'id_personil');
    }
}
