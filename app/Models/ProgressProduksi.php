<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressProduksi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'progress_produksi';
    protected $primaryKey = 'id_progress';
    protected $fillable = [
        'id_detil_renprod',
        'id_tahap',
    ];
}
