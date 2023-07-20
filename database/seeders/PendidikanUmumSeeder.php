<?php

namespace Database\Seeders;

use App\Models\PendidikanUmum;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        $datas = [
            [
                'tingkat_pendidikan' => 'SD',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'tingkat_pendidikan' => 'SMP',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'tingkat_pendidikan' => 'SMA/SMK',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'tingkat_pendidikan' => 'D3',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'tingkat_pendidikan' => 'S1/D4',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'tingkat_pendidikan' => 'S2',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'tingkat_pendidikan' => 'S3',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ];

        PendidikanUmum::truncate();
        foreach ($datas as $key => $data) {
            PendidikanUmum::create($datas[$key]);
        }
    }
}
