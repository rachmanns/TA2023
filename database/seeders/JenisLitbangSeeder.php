<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLitbangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_litbang')->insert([
            [
                'deskripsi' => 'Litbang Bahan Baku Skala Lab',
            ],
            [
                'deskripsi' => 'Litbang Formula Skala Lab',
            ],
            [
                'deskripsi' => 'Registrasi',
            ],
        ]);
    }
}
