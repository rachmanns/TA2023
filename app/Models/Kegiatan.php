<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory, Uuid;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = ['id_event',  'nama_kegiatan'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'id_event', 'id_event');
    }
}
