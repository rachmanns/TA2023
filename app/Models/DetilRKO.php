<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class DetilRKO extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detil_rko';
    protected $primaryKey = 'id_detil_rko';

    public function rko()
    {
        return $this->belongsTo(RKO::class, 'id_rko', 'id_rko');
    }

    public function kemasan()
    {
        return $this->belongsTo(Kemasan::class, 'id_kemasan', 'id_kemasan');
    }

    public function renprod()
    {
        return $this->hasMany(Renprod::class, 'id_detil_rko', 'id_detil_rko');
    }
}
