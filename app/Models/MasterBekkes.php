<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBekkes extends Model
{
    use HasFactory, Uuid;
    protected $table = 'master_bekkes';
    protected $primaryKey = 'id_mas_bek';
    protected $fillable = ['nama_bekkes'];
}
