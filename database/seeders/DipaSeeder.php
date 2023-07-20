<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DipaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('dipa')->truncate();
        DB::table('dipa')->insert([
            [
                'kode_dipa' => 'DIPPUS',
                'nama_dipa' => 'Dipa Pusat',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_dipa' => 'DIPDAR',
                'nama_dipa' => 'Dipa Daerah',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
