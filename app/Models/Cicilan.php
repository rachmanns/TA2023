<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicilan extends Model
{
    use HasFactory, Uuid;
    protected $table = 'cicilan';
    protected $primaryKey = 'id_cicilan';
    protected $fillable = [
        'id_hutang',
        'tgl_bayar',
        'jml_bayar',
        'bukti_bayar'
    ];

    public function hutang()
    {
        return $this->belongsTo(Hutang::class, 'id_hutang');
    }
}
