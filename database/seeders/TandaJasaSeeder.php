<?php

namespace Database\Seeders;

use App\Models\TandaJasa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TandaJasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        TandaJasa::truncate();
        TandaJasa::create(
            [
                'nama_jasa' => 'SL Kesetiaan',
                'keterangan' => 'Kesetiaan',
                'created_at' => $time,
                'updated_at' => $time
            ]
        );
    }
}
