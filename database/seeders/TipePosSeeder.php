<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipePos;
use Carbon\Carbon;

class TipePosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        $data = [
            'kapal',
            'udara',
            'mobile',
            'darat',
        ];

        TipePos::truncate();

        foreach ($data as $key => $value) {

            TipePos::create([
                'tipe' => $value,
                'created_at' => $time,
                'updated_at' => $time
            ]);
        }
    }
}
