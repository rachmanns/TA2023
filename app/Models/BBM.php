<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BBM extends Model
{
    use HasFactory, Uuid;
    protected $table = 'bbm';
    protected $primaryKey = 'id_bbm';

    public function jenis_bbm()
    {
        return $this->belongsTo(JenisBBM::class, 'id_jenis_bbm', 'id_jenis_bbm');
    }
}
