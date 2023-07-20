<?php

namespace Database\Seeders;

use App\Models\Korps;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KorpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Korps::truncate();
        Korps::insert([
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'INF',
                'nama_korps' => 'Korps Infanteri',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'KAV',
                'nama_korps' => 'Korps Kavaleri',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'ARM',
                'nama_korps' => 'Korps Artileri Medan',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'ARH',
                'nama_korps' => 'Korps Artileri Pertahanan Udara',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CZI',
                'nama_korps' => 'Korps Zeni',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CPN',
                'nama_korps' => 'Korps Penerbang',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CHB',
                'nama_korps' => 'Korps Perhubungan',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CPL',
                'nama_korps' => 'Korps Peralatan',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CPM',
                'nama_korps' => 'Korps Polisi Militer',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CBA',
                'nama_korps' => 'Korps Pembekalan dan Angkutan',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CKM',
                'nama_korps' => 'Korps Kesehatan Militer',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CTP',
                'nama_korps' => 'Korps Topografi',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CKU',
                'nama_korps' => 'Korps Keuangan',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CHK',
                'nama_korps' => 'Korps Hukum',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'CAJ',
                'nama_korps' => 'Korps Ajudan Jenderal',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AD',
                'kode_korps' => 'K',
                'nama_korps' => 'Korps Wanita Angkatan Darat',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'AL',
                'kode_korps' => 'BAH',
                'nama_korps' => 'Kejuruan Bahari',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_matra' => 'PNS',
                'kode_korps' => 'KORPRI',
                'nama_korps' => 'Korps Pegawai Republik Indonesia',
                'created_at' => $time,
                'updated_at' => $time
            ],

        ]);
    }
}
