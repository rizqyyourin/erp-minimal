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
                    'dashboard.view',
                    'products.view', 'products.create', 'products.edit', 'products.delete',
                    'customers.view', 'customers.create', 'customers.edit', 'customers.delete',
                    'suppliers.view', 'suppliers.create', 'suppliers.edit', 'suppliers.delete',
                    'invoices.view', 'invoices.create', 'invoices.edit', 'invoices.cancel', 'invoices.delete',
                    'payments.view', 'payments.create',
                    'inventory.view', 'inventory.adjust',
                    'reports.view',
                ],
            ],
            [
                'name' => 'Staff',
                'permissions' => [
                    'products.view', 'products.delete',
                    'customers.view', 'customers.edit',
                    'invoices.view', 'invoices.create',
                    'payments.view', 'payments.create',
                    'inventory.view',
                ],
            ],
            [
                'name' => 'Viewer',
                'permissions' => [
                    'dashboard.view',
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
