<?php

namespace Database\Seeders;

use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Periode::truncate();
        Periode::insert([
            [
                'id_periode' => 1,
                'nama_periode' => 'Triwulan I',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 2,
                'nama_periode' => 'Triwulan II',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 3,
                'nama_periode' => 'Triwulan III',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 4,
                'nama_periode' => 'Triwulan IV',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 5,
                'nama_periode' => 'Quartal I',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 6,
                'nama_periode' => 'Quartal II',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 7,
                'nama_periode' => 'Quartal III',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 8,
                'nama_periode' => 'Semester I',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_periode' => 9,
                'nama_periode' => 'Semester II',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
