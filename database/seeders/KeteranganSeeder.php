<?php

namespace Database\Seeders;

use App\Models\Keterangan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Keterangan::truncate();
        Keterangan::insert([
            [
                'id_keterangan' => 1,
                'keterangan' => 'Rencana',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_keterangan' => 2,
                'keterangan' => 'Batal',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_keterangan' => 3,
                'keterangan' => 'Tunda',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_keterangan' => 4,
                'keterangan' => 'Terlaksana',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_keterangan' => 5,
                'keterangan' => 'Hadir',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
