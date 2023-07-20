<?php

namespace Database\Seeders;

use App\Models\Kesatuan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KesatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Kesatuan::truncate();
        Kesatuan::insert([
            [
                'kode_matra' => 'AD',
                'kode_kesatuan' => 'KORAMIL',
                'nama_kesatuan' => 'KORAMIL',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'PNS',
                'kode_kesatuan' => 'SAMSAT',
                'nama_kesatuan' => 'SAMSAT',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ]);
    }
}
