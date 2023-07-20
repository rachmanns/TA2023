<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilDistribusi extends Model
{
    use HasFactory, Uuid;
    protected $table = 'detil_distribusi';
    protected $primaryKey = 'id_detil_distribusi';
}
