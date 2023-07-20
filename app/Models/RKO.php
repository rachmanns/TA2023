<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class RKO extends Model
{
    use HasFactory, Uuid;
    protected $table = 'rko';
    protected $primaryKey = 'id_rko';

    public function rs()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rs', 'id_rs');
    }

    public function detil_rko()
    {
        return $this->hasMany(DetilRKO::class, 'id_rko', 'id_rko');
    }
}
