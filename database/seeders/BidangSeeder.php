<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('bidang')->truncate();
        DB::table('bidang')->insert([
            [
                'kode_bidang' => 'BIDUM',
                'nama_bidang' => 'BIDUM',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'BIDDUKKESOPS',
                'nama_bidang' => 'BIDDUKKESOPS',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'BIDYANKESIN',
                'nama_bidang' => 'BIDYANKESIN',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'BIDMATFASKES',
                'nama_bidang' => 'BIDMATFASKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'KERMABAKTIKES',
                'nama_bidang' => 'KERMA BAKTIKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'BIDBANGKES',
                'nama_bidang' => 'BIDBANGKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'TAUD',
                'nama_bidang' => 'TAUD',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'DOBEKKES',
                'nama_bidang' => 'DOBEKKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'kode_bidang' => 'LAFIBIOVAK',
                'nama_bidang' => 'LAFIBIOVAK',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
