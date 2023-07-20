<?php

namespace Database\Seeders;

use App\Models\KategoriDokter;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KategoriDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        KategoriDokter::truncate();
        KategoriDokter::insert([
            [
                'id_kategori_dokter' => 1,
                'nama_kategori' => 'Dokter Umum',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori_dokter' => 2,
                'nama_kategori' => 'Dokter Spesialis',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori_dokter' => 3,
                'nama_kategori' => 'Dokter Gigi',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori_dokter' => 4,
                'nama_kategori' => 'Dokter Spesialis Gigi',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori_dokter' => 5,
                'nama_kategori' => 'Dokter Sub Spesialis',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
