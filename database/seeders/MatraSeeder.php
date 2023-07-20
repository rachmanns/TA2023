<?php

namespace Database\Seeders;

use App\Models\Matra;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MatraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Matra::truncate();
        Matra::insert([
            [
                'kode_matra' => 'AD',
                'nama_matra' => 'Angkatan Darat',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AL',
                'nama_matra' => 'Angkatan Laut',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AU',
                'nama_matra' => 'Angkatan Udara',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'PNS',
                'nama_matra' => 'Pegawai Negeri Sipil',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'TNI',
                'nama_matra' => 'Tentara Nasional Indonesia',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'MABES',
                'nama_matra' => 'Markas Besar',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'KB_TNI',
                'nama_matra' => 'Keluarga Besar TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'KB_PNS',
                'nama_matra' => 'Keluarga Besar PNS',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
