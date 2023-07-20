<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanUmum extends Model
{
    use HasFactory, Uuid;

    protected $table = 'pendidikan_umum';
    protected $primaryKey = 'id_pend_umum';
    protected $fillable = ['tingkat_pendidikan'];
}
