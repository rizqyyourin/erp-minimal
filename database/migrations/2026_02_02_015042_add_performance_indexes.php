<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes for customers
        Schema::table('customers', function (Blueprint $table) {
            $table->index('name', 'customers_name_index');
        });

        // Add indexes for suppliers
        Schema::table('suppliers', function (Blueprint $table) {
            $table->index('name', 'suppliers_name_index');
        });

        // Add indexes for payments
        Schema::table('payments', function (Blueprint $table) {
            $table->index('method', 'payments_method_index');
            $table->index('paid_at', 'payments_paid_at_index');
        });

        // Add indexes for inventory_transactions
        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->index('type', 'inventory_transactions_type_index');
        });

        // Add composite index for invoice_items
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->index(['invoice_id', 'product_id'], 'invoice_items_composite_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropIndex('customers_name_index');
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropIndex('suppliers_name_index');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('payments_method_index');
            $table->dropIndex('payments_paid_at_index');
        });

        Schema::table('inventory_transactions', function (Blueprint $table) {
            $table->dropIndex('inventory_transactions_type_index');
        });

        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropIndex('invoice_items_composite_index');
        });
    }
};
