<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLitbang extends Model
{
    use HasFactory;
    protected $table = 'jenis_litbang';
    protected $primaryKey = 'id_jenis';

    public function tahap()
    {
        return $this->hasMany(TahapLitbang::class, 'id_jenis', 'id_jenis');
    }
}
