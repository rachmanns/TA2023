<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranmor extends Model
{
    use HasFactory, Uuid;
    protected $table = 'ranmor';
    protected $primaryKey = 'id_ranmor';
}
