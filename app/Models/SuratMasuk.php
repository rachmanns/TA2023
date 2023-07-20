<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $connection = 'dms';
    protected $table = 'surat_masuk';
    protected $primaryKey = 'sm_id';
}
