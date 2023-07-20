<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahapLitbangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahap_litbang')->insert([
            [
                'tahap_pelaksanaan' => 'Melaksanakan trial Formula skala lab',
                'id_jenis' => '1',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan uji stabilitas skala lab',
                'id_jenis' => '1',
            ],
            [
                'tahap_pelaksanaan' => 'Uji Stabilitas on going skala Pilot',
                'id_jenis' => '1',
            ],
            [
                'tahap_pelaksanaan' => 'Laporan dan Evaluasi',
                'id_jenis' => '1',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan trial Formula skala lab',
                'id_jenis' => '2',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan uji stabilitas skala lab',
                'id_jenis' => '2',
            ],
            [
                'tahap_pelaksanaan' => 'Uji Stabilitas on going skala Pilot',
                'id_jenis' => '2',
            ],
            [
                'tahap_pelaksanaan' => 'Laporan dan Evaluasi',
                'id_jenis' => '2',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan trial Formula skala lab',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan uji stabilitas skala lab',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan trial Formula skala Pilot',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan uji stabilitas skala Pilot',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan pre-validation study batch',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Melaksanakan pengujian sesuai spesifikasi obat yang sudah ditentukan',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Tahap Upload dokumen Praregistrasi dan Registrasi',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Uji Stabilitas on going skala Lab',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Uji Stabilitas on going skala Pilot',
                'id_jenis' => '3',
            ],
            [
                'tahap_pelaksanaan' => 'Laporan dan Evaluasi',
                'id_jenis' => '3',
            ],
        ]);
    }
}
