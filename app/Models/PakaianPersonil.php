<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakaianPersonil extends Model
{
    use HasFactory, Uuid;
    protected $table = 'pakaian_personil';
    protected $primaryKey = 'id_pakaian_personil';
    protected $fillable = [
        'id_personil',
        'id_pakaian',
        'ukuran'
    ];

    public function pakaian()
    {
        return $this->belongsTo(Pakaian::class, 'id_pakaian', 'id_pakaian');
    }
}
