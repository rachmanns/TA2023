<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Uuid;

    protected $table = 'event';
    protected $primaryKey = 'id_event';
    protected $fillable = ['id_jenis_kerma',  'nama_event'];

    public function jenis_kerma()
    {
        return $this->belongsTo(JenisKerma::class, 'id_jenis_kerma', 'id_jenis_kerma');
    }
}
