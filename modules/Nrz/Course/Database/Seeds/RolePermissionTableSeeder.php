<?php

namespace Nrz\Course\Database\Seeds;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionTableSeeder extends Seeder
{

    public function run()
    {
        Permission::findOrCreate('manage categories');
        Permission::findOrCreate('manage role_permissions');
        Permission::findOrCreate('teach');
        Role::findOrCreate('teacher')->givePermissionTo(['teach']);
    }
}
