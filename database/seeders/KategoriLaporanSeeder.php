<?php

namespace Database\Seeders;

use App\Models\KategoriLaporan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KategoriLaporanSeeder extends Seeder
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
                'id_kat_lap' => 1,
                'nama_kat_lap' => 'Neraca BMN',
                'type' => 'R'
            ],
            [
                'id_kat_lap' => 2,
                'nama_kat_lap' => 'Laporan Rincian Persediaan',
                'type' => 'R'
            ],
            [
                'id_kat_lap' => 3,
                'nama_kat_lap' => 'Laporan BMN',
                'type' => 'R'
            ],
            [
                'id_kat_lap' => 4,
                'nama_kat_lap' => 'Penghapusan Khusus',
                'type' => 'R'
            ],
            [
                'id_kat_lap' => 5,
                'nama_kat_lap' => 'Alat Besar',
                'type' => 'M'
            ],
            [
                'id_kat_lap' => 6,
                'nama_kat_lap' => 'Aset Tak Berwujud',
                'type' => 'M'
            ],
            [
                'id_kat_lap' => 7,
                'nama_kat_lap' => 'Alat Angkut Bermotor',
                'type' => 'M'
            ],
            [
                'id_kat_lap' => 8,
                'nama_kat_lap' => 'Gedung dan Bangunan',
                'type' => 'M'
            ],
            [
                'id_kat_lap' => 9,
                'nama_kat_lap' => 'Alsintor',
                'type' => 'M'
            ],
            [
                'id_kat_lap' => 10,
                'nama_kat_lap' => 'Tanah',
                'type' => 'M'
            ],
            [
                'id_kat_lap' => 11,
                'nama_kat_lap' => 'Aset Tetap Lainnya',
                'type' => 'M'
            ],
        ];

        KategoriLaporan::truncate();

        foreach ($data as $key => $value) {

            KategoriLaporan::create($data[$key]);
        }
    }
}
