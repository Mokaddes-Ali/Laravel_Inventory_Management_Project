<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;


use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',


            'sale-list',
            'sale-create',
            'sale-edit',
            'sale-delete',


            'setting',
            'databasebackup',

         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
    }
}
}
