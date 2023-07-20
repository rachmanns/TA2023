<?php

namespace Database\Seeders;

use App\Models\JenisKegDuk;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JenisKegiatanDukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        JenisKegDuk::truncate();
        JenisKegDuk::insert([
            [
                'id_jenis_keg_duk' => 1,
                'nama_jenis' => 'Werving',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_jenis_keg_duk' => 2,
                'nama_jenis' => 'Satgas LN',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_jenis_keg_duk' => 3,
                'nama_jenis' => 'Pendidikan',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ]);
    }
}
