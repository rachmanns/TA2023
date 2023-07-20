<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RumahSakit;
use App\Models\User;

class FaskesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rs = RumahSakit::select('nama_rs')->get();
        foreach($rs as $r) {
            $user = User::create([
                'name' => $r->nama_rs,
                'email' => strtolower(str_replace([' ', '.', '/'], '', $r->nama_rs)) . '@puskes-tni.mil.id',
                'password' => '$2y$10$6yo0FeAm1E46uhNncPdL/.hxE0n/.oAznlvN26RTvUs0PCTe1i5l6' //password
            ]);
            $user->assignRole([14]);

            unset($user);
        }
    }
}
