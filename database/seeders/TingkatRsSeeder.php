<?php

namespace Database\Seeders;

use App\Models\TingkatRS;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TingkatRsSeeder extends Seeder
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
            'RS TINGKAT PUSAT',
            'RS TK I',
            'RS TK II',
            'RS TK III',
            'RS TK IV',
            'RS KHUSUS',
        ];

        TingkatRS::truncate();

        foreach ($data as $key => $value) {

            TingkatRS::create(['nama_tingkat_rs' => $value]);
        }
    }
}
