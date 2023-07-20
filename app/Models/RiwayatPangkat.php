<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    use HasFactory, Uuid;
    protected $table = 'riwayat_pangkat';
    protected $primaryKey = 'id_riwayat_pangkat';
    protected $fillable = [
        'id_pangkat',
        'id_personil',
        'tmt_pangkat',
        'no_skep_pangkat',
        'tgl_skep_pangkat',
        'no_sprin_pangkat',
        'tgl_sprin_pangkat'
    ];

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'id_pangkat', 'id_pangkat');
    }
}
