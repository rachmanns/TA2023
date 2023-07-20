<?php

namespace Database\Seeders;

use App\Models\JenisSpesialis;
use Illuminate\Database\Seeder;

class JenisSpesialisSeeder extends Seeder
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
                'id_spesialis' => 1,
                'id_kategori_dokter' => 1,
                'nama_spesialis' => '-',
            ],
            [
                'id_spesialis' => 2,
                'id_kategori_dokter' => 3,
                'nama_spesialis' => '-',
            ]
        ];

        JenisSpesialis::truncate();
        JenisSpesialis::insert($data);
    }
}
