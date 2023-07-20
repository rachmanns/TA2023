<?php

namespace Database\Seeders;

use App\Models\GradeEselon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);

        $this->call(AngkatanSeeder::class);
        $this->call(DipaSeeder::class);
        $this->call(GradeEselonSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(KategoriLaporanSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(KesatuanSeeder::class);
        $this->call(KorpsSeeder::class);
        $this->call(MatraSeeder::class);
        $this->call(PakaianSeeder::class);
        $this->call(PangkatSeeder::class);
        $this->call(PendidikanUmumSeeder::class);
        $this->call(TandaJasaSeeder::class);
        $this->call(TingkatRsSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
