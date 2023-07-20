<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakaian extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pakaian';
    protected $primaryKey = 'id_pakaian';
    protected $fillable = [
        'item_pakaian'
    ];

    public function pakaian_personil()
    {
        return $this->hasMany(PakaianPersonil::class, 'id_pakaian', 'id_pakaian');
    }
}
