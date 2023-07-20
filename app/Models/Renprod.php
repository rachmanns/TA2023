<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Renprod extends Model
{
    use HasFactory, Uuid;
    protected $table = 'renprod';
    protected $primaryKey = 'id_renprod';

    public function kemasan()
    {
        return $this->belongsTo(Kemasan::class, 'id_kemasan', 'id_kemasan');
    }

    public function detil_renprod()
    {
        return $this->hasMany(DetilRenprod::class, 'id_renprod', 'id_renprod');
    }
}
