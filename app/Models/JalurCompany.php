<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurCompany extends Model
{
    use HasFactory, Uuid;
    protected $table = 'jalur_company';
    protected $primaryKey = 'id_jalur_company';

    public function litbang()
    {
        return $this->hasMany(Litbang::class, 'id_jalur_company', 'id_jalur_company');
    }
}
