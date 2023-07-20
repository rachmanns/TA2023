<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangStruktur extends Model
{
    use HasFactory;
    protected $table = 'bidang_struktur';

    public function detail()
    {
        return $this->hasMany(BidangStrukturDetail::class, 'bidang_id', 'id');
    }
}
