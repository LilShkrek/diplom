<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Сброс кеша разрешений
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Создаём роли
        $adminRole = Role::where('name', 'admin')->first() ?? Role::create(['name' => 'admin']);
        $managerRole = Role::where('name', 'manager')->first() ?? Role::create(['name' => 'manager']);
        $operatorRole = Role::where('name', 'operator')->first() ?? Role::create(['name' => 'operator']);

        $permissions = [
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'licences.view',
            'licences.create',
            'licences.edit',
            'licences.delete',
            'facilities.view',
            'facilities.create',
            'facilities.edit',
            'facilities.delete',
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::where('name', $permission)->first() ?? Permission::create(['name' => $permission]);
        }

        // Назначаем разрешения ролям (явно перечисляем!)
        $adminRole->givePermissionTo([
            'users.create',
            'users.delete',
            'users.edit',
            'users.view'
        ]);

        $managerRole->givePermissionTo([
            'licences.view',
            'facilities.view',
            'employees.view'
        ]);

        $operatorRole->givePermissionTo([
            'licences.view',
            'licences.create',
            'licences.edit',
            'licences.delete',
            'facilities.view',
            'facilities.create',
            'facilities.edit',
            'facilities.delete',
            'employees.view',
            'employees.create',
            'employees.edit',
            'employees.delete',
            // ... остальные разрешения оператора           //TODO:: добавить разрешения (вроде все добавил, перепроверить)
        ]);

        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('operator');
        User::find(3)->assignRole('manager');
    }
}
