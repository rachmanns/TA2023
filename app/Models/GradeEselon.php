<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeEselon extends Model
{
    use HasFactory, Uuid;
    protected $table = 'grade_eselon';
    protected $primaryKey = 'id_gr_es';
    protected $fillable = [
        'id_gr_es',
        'grade',
        'eselon',
        'id_pangkat'
    ];
}
