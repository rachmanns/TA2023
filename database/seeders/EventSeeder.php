<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'id_event' => 1,
                'id_jenis_kerma' => 1,
                'nama_event' => 'USIBDD',
            ],
            [
                'id_event' => 2,
                'id_jenis_kerma' => 1,
                'nama_event' => 'THAINESIA',
            ],
            [
                'id_event' => 3,
                'id_jenis_kerma' => 2,
                'nama_event' => 'MULTILATERAL',
            ],
            [
                'id_event' => 4,
                'id_jenis_kerma' => 3,
                'nama_event' => 'DAGRI',
            ],
        ];

        Event::truncate();
        Event::insert($data);

        // $faker = Faker::create('id_ID');
        // for($x = 1; $x <= 10; $x++){
        //     DB::table('event')->insert([
        //         'start' => $faker->date,
        //         'nama_event' => $faker->name,
        //         'tempat_event' => $faker->citySuffix,
        //         'finish' => $faker->date,
        //     ]);
        // }
    }
}
