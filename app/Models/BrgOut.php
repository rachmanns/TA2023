<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class BrgOut extends Model
{
    use HasFactory, Uuid;
    protected $table = 'brg_out';
    protected $primaryKey = 'id_brg_out';

    public function detail_brg_matkes_d()
    {
        return $this->belongsTo(DetailBrgMatkesD::class, 'id_matkes_dobek', 'id_matkes_dobek');
    }
}
