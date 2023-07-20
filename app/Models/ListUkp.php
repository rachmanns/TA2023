<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListUkp extends Model
{
    use HasFactory, Uuid;
    protected $table = 'list_ukp';
    protected $primaryKey = 'id_list_ukp';
    protected $fillable = [
        'periode',
        'id_personil',
        'pangkat_terakhir',
        'tmt_pangkat_terakhir',
        'target_tmt_kenkat',
        'status',
        'keterangan',
    ];

    public function personil()
    {
        return $this->belongsTo(Personil::class, 'id_personil', 'id_personil');
    }
}
