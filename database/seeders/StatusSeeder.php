<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        Status::truncate();
        Status::insert([
            [
                'id_status' => 1,
                'nama_status' => 'Undangan',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_status' => 2,
                'nama_status' => 'Tuan Rumah',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'id_status' => 3,
                'nama_status' => 'Mandiri',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
