<?php

namespace Database\Seeders;

use App\Models\BidangStruktur;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BidangStrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        BidangStruktur::insert([
            [
                'nama_struktur' => 'SUBBIDMINPERS',
                'kode' => 'SUBBIDMINPERS',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'SUBBIDRENPROGAR BIDUM',
                'kode' => 'SUBBIDRENPROGAR',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'SUBBIDLOG BIDUM',
                'kode' => 'SUBBIDLOG',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'YANKESIN',
                'kode' => 'YANKESIN',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'MATFASKES',
                'kode' => 'MATFASKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'DOBEKKES',
                'kode' => 'DOBEKKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'KERMABAKTIKES',
                'kode' => 'KERMABAKTIKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'LAFIBIOVAK',
                'kode' => 'LAFIBIOVAK',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'DUKKESOP',
                'kode' => 'DUKKESOP',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'TAUD',
                'kode' => 'TAUD',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'nama_struktur' => 'BANGKES',
                'kode' => 'BANGKES',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ]);

    }
}
