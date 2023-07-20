<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory, Uuid;
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    protected $fillable = ['nama_status'];
}
