<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($x = 1; $x <= 10; $x++){
            DB::table('company')->insert([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'telepon' => $faker->PhoneNumber,
                'email' => $faker->freeEmail,
                'website' => $faker->url,
            ]);
        }
    }
}
