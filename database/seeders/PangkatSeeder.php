<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
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
            [
                'id_pangkat' => 1,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Bintang 2',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira Tinggi',
                'next_pangkat' => null,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 2,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Bintang 1',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira Tinggi',
                'next_pangkat' => 1,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 3,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Kolonel',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira',
                'next_pangkat' => 2,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 4,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Letkol',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira',
                'next_pangkat' => 3,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 5,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Mayor',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira',
                'next_pangkat' => 4,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 6,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Kapten',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira',
                'next_pangkat' => 5,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 7,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Lettu',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira',
                'next_pangkat' => 6,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 8,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Letda',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Perwira',
                'next_pangkat' => 7,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 9,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Peltu',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Bintara',
                'next_pangkat' => 8,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 10,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Pelda',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'Bintara',
                'next_pangkat' => 9,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 11,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Serma',
                'masa_kenkat' => 5,
                'jenis_pangkat' => 'Bintara',
                'next_pangkat' => 10,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 12,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Serka',
                'masa_kenkat' => 5,
                'jenis_pangkat' => 'Bintara',
                'next_pangkat' => 11,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 13,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Sertu',
                'masa_kenkat' => 5,
                'jenis_pangkat' => 'Bintara',
                'next_pangkat' => 12,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 14,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Serda',
                'masa_kenkat' => 5,
                'jenis_pangkat' => 'Bintara',
                'next_pangkat' => 13,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 15,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Kopka',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'Tamtama',
                'next_pangkat' => 14,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 16,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Koptu',
                'masa_kenkat' => 5,
                'jenis_pangkat' => 'Tamtama',
                'next_pangkat' => 15,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 17,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Kopda',
                'masa_kenkat' => 5,
                'jenis_pangkat' => 'Tamtama',
                'next_pangkat' => 16,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 18,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Praka',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'Tamtama',
                'next_pangkat' => 17,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 19,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Pratu',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'Tamtama',
                'next_pangkat' => 18,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 20,
                'kode_matra' => 'TNI',
                'nama_pangkat' => 'Prada',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'Tamtama',
                'next_pangkat' => 19,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 53
            ],
            [
                'id_pangkat' => 21,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL IV/D',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => null,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 60
            ],
            [
                'id_pangkat' => 22,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL IV/C',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 21,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 60
            ],
            [
                'id_pangkat' => 23,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL IV/B',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 22,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 60
            ],
            [
                'id_pangkat' => 24,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL IV/A',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 23,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 60
            ],
            [
                'id_pangkat' => 25,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL III/D',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 24,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 26,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL III/C',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 25,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 27,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL III/B',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 26,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 28,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL III/A',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 27,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 29,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL II/D',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 28,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 30,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL II/C',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 29,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 31,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL II/B',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 30,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 32,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL II/A',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 31,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 33,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL I/D',
                'masa_kenkat' => 0,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 32,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 34,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL I/C',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 33,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 35,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL I/B',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 34,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
            [
                'id_pangkat' => 36,
                'kode_matra' => 'PNS',
                'nama_pangkat' => 'GOL I/A',
                'masa_kenkat' => 4,
                'jenis_pangkat' => 'PNS',
                'next_pangkat' => 35,
                'created_at' => $time,
                'updated_at' => $time,
                'usia_pensiun' => 58
            ],
        ];

        Pangkat::truncate();
        Pangkat::insert($data);
    }
}
