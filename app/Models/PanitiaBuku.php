<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaBuku extends Model
{
    use HasFactory, Uuid;
    protected $table = 'panitia_buku';
    protected $primaryKey = 'id_panitia';
    protected $fillable = [
        'id_event_buku',
        'id_personil',
    ];
}
