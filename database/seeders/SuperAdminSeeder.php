<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create Super Admin role with all permissions
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            [
                'permissions' => ['*'], // All permissions
            ]
        );

        // Create super admin user
        User::firstOrCreate(
            ['email' => 'dev@erp.co.id'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Erp123@'),
                'role_id' => $superAdminRole->id,
            ]
        );

        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: dev@erp.co.id');
        $this->command->info('Password: Erp123@');
    }
}
