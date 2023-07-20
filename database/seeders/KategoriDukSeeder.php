<?php

namespace Database\Seeders;

use App\Models\KategoriDuk;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KategoriDukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        KategoriDuk::truncate();
        KategoriDuk::insert([
            [
                'id_kat_duk' => 1,
                'id_jenis_keg_duk' => 1,
                'nama_kategori' => 'PA PK GAKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 2,
                'id_jenis_keg_duk' => 1,
                'nama_kategori' => 'PA PK REGULER',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 3,
                'id_jenis_keg_duk' => 1,
                'nama_kategori' => 'MABEA',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 4,
                'id_jenis_keg_duk' => 1,
                'nama_kategori' => 'PSDP TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 5,
                'id_jenis_keg_duk' => 2,
                'nama_kategori' => 'SATGAS KIZI MINUSCA',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 6,
                'id_jenis_keg_duk' => 2,
                'nama_kategori' => 'SATGAS BGC TNI KONGA',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 7,
                'id_jenis_keg_duk' => 2,
                'nama_kategori' => 'SATGAS YONMEK TNI KONGA',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 8,
                'id_jenis_keg_duk' => 2,
                'nama_kategori' => '6 SATGAS TNI KONGA',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 9,
                'id_jenis_keg_duk' => 2,
                'nama_kategori' => 'SATGAS KIZI MONUSCO',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 10,
                'id_jenis_keg_duk' => 2,
                'nama_kategori' => 'SATGAS STANDBY MILOBS/MILSTAFF',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kat_duk' => 11,
                'id_jenis_keg_duk' => 3,
                'nama_kategori' => 'Sesko TNI',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ]);
    }
}
