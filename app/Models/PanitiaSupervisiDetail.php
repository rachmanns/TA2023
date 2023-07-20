<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanitiaSupervisiDetail extends Model
{
    use HasFactory, Uuid;
    protected $table = 'panitia_supervisi_detail';
    protected $primaryKey = 'id_panitia';
    protected $fillable = [
        'id_supervisi',
        'id_panitia_supervisi'
    ];
}
