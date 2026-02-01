<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'permissions' => ['*'],
            ],
            [
                'name' => 'Manager',
                'permissions' => [
                    'products.view',
                    'products.edit',
                    'customers.view',
                    'customers.edit',
                    'suppliers.view',
                    'suppliers.edit',
                    'invoices.view',
                    'invoices.create',
                    'invoices.edit',
                    'invoices.cancel',
                    'payments.view',
                    'payments.create',
                    'inventory.view',
                    'inventory.adjust',
                    'reports.view',
                ],
            ],
            [
                'name' => 'Staff',
                'permissions' => [
                    'products.view',
                    'customers.view',
                    'customers.edit',
                    'invoices.view',
                    'invoices.create',
                    'payments.view',
                    'payments.create',
                    'inventory.view',
                ],
            ],
            [
                'name' => 'Viewer',
                'permissions' => [
                    'products.view',
                    'customers.view',
                    'invoices.view',
                    'inventory.view',
                    'reports.view',
                ],
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}
