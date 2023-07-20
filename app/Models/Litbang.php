<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Litbang extends Model
{
    use HasFactory, Uuid;
    protected $table = 'litbang';
    protected $primaryKey = 'id_litbang';

    public function jalur_company()
    {
        return $this->belongsTo(JalurCompany::class, 'id_jalur_company', 'id_jalur_company');
    }

    public function checklist()
    {
        return $this->hasMany(ChecklistLitbang::class, 'id_litbang', 'id_litbang');
    }
}
