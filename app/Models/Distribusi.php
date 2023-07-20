<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'distribusi';
    protected $primaryKey = 'id_distribusi';

    public function kemasan()
    {
        return $this->belongsTo(Kemasan::class, 'id_kemasan', 'id_kemasan');
    }

    public function rs()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rs', 'id_rs');
    }

    public function detil_distribusi()
    {
        return $this->hasMany(DetilDistribusi::class, 'id_distribusi', 'id_distribusi');
    }
}
