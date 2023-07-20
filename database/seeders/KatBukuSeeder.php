<?php

namespace Database\Seeders;

use App\Models\KatBuku;
use Illuminate\Database\Seeder;

class KatBukuSeeder extends Seeder
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
                'id_kat_buku' => 1,
                'nama_kat_buku' => 'Perpang'
            ],
            [
                'id_kat_buku' => 2,
                'nama_kat_buku' => 'Jukgar'
            ],
            [
                'id_kat_buku' => 3,
                'nama_kat_buku' => 'Juknis'
            ],
            [
                'id_kat_buku' => 4,
                'nama_kat_buku' => 'Naskah Sementara'
            ],
        ];

        KatBuku::truncate();
        KatBuku::insert($data);
    }
}
