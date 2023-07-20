<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [
            'master_data.list',
            'master_data.manage',
            'role_permission.list',
            'role_permission.manage',
            'users.list',
            'users.manage',
            'bidum.dashboard',
            'bidum.list',
            'bidum.manage',
            'subbidminpers.dashboard',
            'subbidminpers.list',
            'subbidminpers.manage',
            'anggaran.dashboard',
            'anggaran.list',
            'anggaran.manage',
            'logistik.dashboard',
            'logistik.list',
            'logistik.manage',
            'taud.dashboard',
            'taud.list',
            'taud.manage',
            'yankesin.dashboard',
            'yankesin.list',
            'yankesin.manage',
            'matfaskes.dashboard',
            'matfaskes.list',
            'matfaskes.manage',
            'dobekkes.dashboard',
            'dobekkes.list',
            'dobekkes.manage',
            'kermabaktikes.dashboard',
            'kermabaktikes.list',
            'kermabaktikes.manage',
            'lafibiovak.dashboard',
            'lafibiovak.list',
            'lafibiovak.manage',
            'dukkesops.dashboard',
            'dukkesops.list',
            'dukkesops.manage',
            'rumah_sakit.dashboard',
            'rumah_sakit.list',
            'rumah_sakit.manage',
            'bangkes.dashboard',
            'bangkes.list',
            'bangkes.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }

        $permissions_list = [
            'Super Admin' => [
                'master_data.list',
                'master_data.manage',
                'role_permission.list',
                'role_permission.manage',
                'users.list',
                'users.manage',
            ],
            "BIDUM" => [
                'bidum.dashboard',
                'bidum.list',
                'bidum.manage',
                'subbidminpers.dashboard',
                'subbidminpers.list',
                'subbidminpers.manage',
                'logistik.dashboard',
                'logistik.list',
                'logistik.manage',
                'anggaran.dashboard',
                'anggaran.list',
                'anggaran.manage',
            ],
            "SUBBIDMINPERS" => [
                'subbidminpers.dashboard',
                'subbidminpers.list',
                'subbidminpers.manage',
            ],
            "LOGISTIK" => [
                'logistik.dashboard',
                'logistik.list',
                'logistik.manage',
            ],
            "ANGGARAN" => [
                'anggaran.dashboard',
                'anggaran.list',
                'anggaran.manage',
            ],
            "TAUD" => [
                'taud.dashboard',
                'taud.list',
                'taud.manage',
            ],
            "YANKESIN" => [
                'yankesin.dashboard',
                'yankesin.list',
                'yankesin.manage',
            ],
            "MATFASKES" => [
                'matfaskes.dashboard',
                'matfaskes.list',
                'matfaskes.manage',
            ],
            "DOBEKKES" => [
                'dobekkes.dashboard',
                'dobekkes.list',
                'dobekkes.manage',
            ],
            "KERMABAKTIKES" => [
                'kermabaktikes.dashboard',
                'kermabaktikes.list',
                'kermabaktikes.manage',
            ],
            "LAFIBIOVAK" => [
                'lafibiovak.dashboard',
                'lafibiovak.list',
                'lafibiovak.manage',
            ],
            "DUKKESOPS" => [
                'dukkesops.dashboard',
                'dukkesops.list',
                'dukkesops.manage',
            ],
            "PIMPINAN" => [
                'pimpinan.dashboard',
                'dukkesops.dashboard',
                'lafibiovak.dashboard',
                'kermabaktikes.dashboard',
                'dobekkes.dashboard',
                'matfaskes.dashboard',
                'yankesin.dashboard',
                'taud.dashboard',
                'bidum.dashboard',
            ],
            "RUMAH SAKIT" => [
                'rumah_sakit.dashboard',
                'rumah_sakit.list',
                'rumah_sakit.manage',
            ],
            "BANGKES" => [
                'bangkes.dashboard',
                'bangkes.list',
                'bangkes.manage',
            ]
        ];

        $users = array(
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'BIDUM',
                'email' => 'bidum@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'SUBBIDMINPERS',
                'email' => 'subbidminpers@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'ANGGARAN',
                'email' => 'anggaran@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'LOGISTIK',
                'email' => 'logistik@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'TAUD',
                'email' => 'taud@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'YANKESIN',
                'email' => 'yankesin@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'MATFASKES',
                'email' => 'matfaskes@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'DOBEKKES',
                'email' => 'dobekkes@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'KERMABAKTIKES',
                'email' => 'kermabaktikes@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'LAFIBIOVAK',
                'email' => 'lafibiovak@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'DUKKESOPS',
                'email' => 'dukkesops@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'PIMPINAN',
                'email' => 'pimpinan@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'RUMAH SAKIT',
                'email' => 'rumahsakit@gmail.com',
                'password' => bcrypt('password'), //password
            ],
            [
                'name' => 'BANGKES',
                'email' => 'bangkes@gmail.com',
                'password' => bcrypt('password'), //password
            ],

        );

        foreach ($users as $value) {

            $user = User::create($value);

            $role = Role::create(['name' => $value['name']]);
            $user->assignRole([$role->id]);

            unset($user);
            unset($role);
        }




        $all_role = Role::get();

        foreach ($all_role as $value) {

            if ($value->name != "Super Admin") $permission = Permission::whereIn("name", $permissions_list[$value->name])->pluck('id', 'id');
            else $permission = Permission::pluck('id', 'id')->all();

            $value->syncPermissions($permission);
            unset($permission);
        }
    }
}
