<?php

namespace App\Services;

use App\Models\Internship;

class InternshipService
{
    public static function count_internship()
    {
        $internship = Internship::get();
        return [
            'wahana' => $internship->where('tgl_selesai', null)->count(),
            'selesai' => $internship->where('tgl_selesai', '<>', null)->count()
        ];
    }
}
