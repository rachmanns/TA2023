<?php

namespace Database\Seeders;

use App\Models\Pakaian;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PakaianSeeder extends Seeder
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
            'PDH',
            'PDL',
            'PDU',
            'Baju Olahraga',
            'Jaket',
            'Kaos',
            'Baret',
            'Topi Pet',
            'Topi Mute',
            'Topi PDU',
            'Topi PDL',
            'Topi Rimba',
            'Helm',
            'Peci',
            'Sarung Tangan',
            'Sabuk Hitam',
            'Sabuk Putih',
            'Kopelriem',
            'Sepatu PDH',
            'Sepatu PDL',
            'Sepatu PDU',
            'Sepatu Olahraga',
            'Kaos Kaki',
            'Pedang',
        ];

        Pakaian::truncate();

        foreach ($data as $key => $value) {

            Pakaian::create(['item_pakaian' => $value]);
        }
    }
}
