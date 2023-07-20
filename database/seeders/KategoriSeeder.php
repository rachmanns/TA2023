<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
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
                'id_kategori' => 1,
                'nama_kategori' => 'AKTIF',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => 'PENSIUN',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'UNDUR DIRI',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_kategori' => 4,
                'nama_kategori' => 'MUTASI',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];

        Kategori::truncate();

        foreach ($data as $key => $value) {
            Kategori::create($data[$key]);
        }
    }
}
