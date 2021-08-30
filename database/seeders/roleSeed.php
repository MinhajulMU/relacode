<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modules\Module\Models\Module;
use App\Models\Role;
use App\Models\RolePrivilege;
use DB;

class roleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $roles = ['Superadmin', 'Admin'];
        foreach ($roles as $role) {
            $roleModel = Role::create([
                'id_role' => $faker->uuid,
                'role_name' => $role,
                'role_slug' => strtolower($role)
            ]);
            if ($role === "Superadmin") {
                $modules = Module::all();
                foreach ($modules as $module) {
                    RolePrivilege::create([
                        'id_role_privilege' => $faker->uuid,
                        'id_role' => $roleModel->id_role,
                        'id_module' => $module->id_module,
                        'can_create' => 1,
                        'can_read' => 1,
                        'can_update' => 1,
                        'can_delete' => 1,
                        'can_validate' => 0
                    ]);
                }
            }
        }
    }
}
