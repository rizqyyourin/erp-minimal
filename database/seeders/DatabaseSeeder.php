<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Intentionally left blank: no demo data seeded.
        // Production-first empty database; tenants created via registration flow.
    }
}
