<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistLitbang extends Model
{
    use HasFactory, Uuid;
    protected $table = 'checklist_litbang';
    protected $primaryKey = 'id_checklist';
}
