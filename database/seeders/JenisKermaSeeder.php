<?php

namespace Database\Seeders;

use App\Models\JenisKerma;
use Illuminate\Database\Seeder;

class JenisKermaSeeder extends Seeder
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
                'id_jenis_kerma' => 1,
                'jenis_kerma' => 'BILATERAL',
                'cakupan' => 'luar negeri',
            ],
            [
                'id_jenis_kerma' => 2,
                'jenis_kerma' => 'NONBILATERAL',
                'cakupan' => 'luar negeri',
            ],
            [
                'id_jenis_kerma' => 3,
                'jenis_kerma' => 'NONBILATERAL',
                'cakupan' => 'dalam negeri',
            ],
        ];

        JenisKerma::truncate();
        JenisKerma::insert($data);
    }
}
