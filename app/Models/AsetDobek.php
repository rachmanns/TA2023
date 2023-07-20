<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class AsetDobek extends Model
{
    use HasFactory, Uuid;
    protected $table = 'aset_dobek';
    protected $primaryKey = 'id_aset';
}
