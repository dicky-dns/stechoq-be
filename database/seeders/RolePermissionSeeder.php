<?php

namespace Database\Seeders;

use App\Enums\Permission as PermissionEnums;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = array_map(
            fn (PermissionEnums $permission) => $permission->value,
            PermissionEnums::cases()
        );

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'sanctum',
            ]);
        }

        $manager = Role::firstOrCreate([
            'name' => 'manager',
            'guard_name' => 'sanctum',
        ]);

        $engineer = Role::firstOrCreate([
            'name' => 'engineer',
            'guard_name' => 'sanctum',
        ]);

        $manager->syncPermissions($permissions);
        $engineer->syncPermissions([
            PermissionEnums::ProjectView->value,
            PermissionEnums::IssueView->value,
            PermissionEnums::IssueUpdate->value,
            PermissionEnums::ReportView->value,
        ]);
    }
}
