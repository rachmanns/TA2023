<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKerma extends Model
{
    use HasFactory, Uuid;

    const BILATERAL_LN = 1;
    const NONBILATERAL_LN = 2;

    protected $table = 'jenis_kerma';
    protected $primaryKey = 'id_jenis_kerma';
    protected $fillable = [
        'jenis_kerma',
        'cakupan'
    ];
}
