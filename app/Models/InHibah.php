<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InHibah extends Model
{
    use HasFactory, Uuid;
    protected $table = 'in_hibah';
    protected $primaryKey = 'id_in_hibah';
    protected $fillable = [
        'tgl_upload',
        'kode_ba',
        'nominal',
        'no_app_hibah',
        'file_app_hibah',
    ];

    public function ba_hibah()
    {
        return $this->belongsTo(BaHibah::class, 'kode_ba', 'kode_ba_hibah');
    }
}
