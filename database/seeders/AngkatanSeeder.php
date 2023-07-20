<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Angkatan::truncate();
        Angkatan::insert(
            [
                [
                    'id_angkatan' => 1,
                    'code_angkatan' => 'KESDAM',
                    'kode_matra' => 'AD',
                    'nama_angkatan' => 'KESDAM',
                    'level' => 'kom',
                    'parent' => null,
                    'created_at' => $time,
                    'updated_at' => $time
                ],
                [
                    'id_angkatan' => 2,
                    'code_angkatan' => 'ARMADA1',
                    'kode_matra' => 'AL',
                    'nama_angkatan' => 'ARMADA 1',
                    'level' => 'kom',
                    'parent' => null,
                    'created_at' => $time,
                    'updated_at' => $time
                ],
                [
                    'id_angkatan' => 3,
                    'code_angkatan' => 'LANTAMAL1',
                    'kode_matra' => 'AL',
                    'nama_angkatan' => 'LANTAMAL 1',
                    'level' => 'sub',
                    'parent' => 2,
                    'created_at' => $time,
                    'updated_at' => $time
                ],
                [
                    'id_angkatan' => 4,
                    'code_angkatan' => 'LANTAMAL',
                    'kode_matra' => 'AL',
                    'nama_angkatan' => 'LANTAMAL',
                    'level' => 'sub',
                    'parent' => 2,
                    'created_at' => $time,
                    'updated_at' => $time
                ],

            ]
        );
    }
}
