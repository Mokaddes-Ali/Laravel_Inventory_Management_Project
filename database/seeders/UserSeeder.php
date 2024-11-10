<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'user-list',
            'user-create',
            'user-edit',

            'customer-list',
            'customer-create',
            'customer-edit',


            'category-list',
            'category-create',
            'category-edit',


            'brand-list',
            'brand-create',
            'brand-edit',


            'product-list',
            'product-create',
            'product-edit',

            'sale-list',
            'sale-create',
            'sale-edit',

        ]);
        $staffRole = Role::create(['name' => 'staff']);

        $staffRole->givePermissionTo([
            'user-list',
            'customer-list',
            'category-list',
            'brand-list',
            'product-list',
            'sale-list',


        ]);
        $userRole = Role::create(['name' => 'user']);

        $userRole->givePermissionTo([
            'user-list',
            'customer-list',
            'category-list',
            'brand-list',
            'product-list',
            'sale-list',
        ]);

        // Create and assign role to Super Admin user
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $superAdminUser->assignRole($superAdminRole);

        // Create and assign role to Admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
            ]
        );
        $adminUser->assignRole($adminRole);

        // Create and assign role to Staff user
        $staffUser = User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff',
                'password' => Hash::make('12345678'),
            ]
        );
        $staffUser->assignRole($staffRole);
    }
}
