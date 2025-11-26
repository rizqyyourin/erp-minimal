<?php

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can list suppliers', function () {
    Supplier::factory(5)->create(['tenant_id' => $this->tenant->id]);

    $response = $this->get(route('suppliers.index'));

    $response->assertStatus(200);
    $response->assertViewHas('suppliers');
});

test('can create supplier', function () {
    $supplierData = [
        'name' => 'Test Supplier Inc',
        'email' => 'supplier@example.com',
        'phone' => '08123456789',
        'lead_time_days' => 7,
    ];

    $response = $this->post(route('suppliers.store'), $supplierData);

    $response->assertRedirect(route('suppliers.index'));
    $this->assertDatabaseHas('suppliers', [
        'name' => 'Test Supplier Inc',
        'email' => 'supplier@example.com',
        'tenant_id' => $this->tenant->id,
    ]);
});

test('can update supplier', function () {
    $supplier = Supplier::factory()->create([
        'tenant_id' => $this->tenant->id,
        'name' => 'Old Supplier',
    ]);

    $response = $this->put(route('suppliers.update', $supplier), [
        'name' => 'Updated Supplier',
        'email' => $supplier->email,
        'phone' => $supplier->phone,
        'lead_time_days' => 14,
    ]);

    $response->assertRedirect(route('suppliers.index'));
    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'Updated Supplier',
        'lead_time_days' => 14,
    ]);
});

test('can delete supplier', function () {
    $supplier = Supplier::factory()->create([
        'tenant_id' => $this->tenant->id,
    ]);

    $response = $this->delete(route('suppliers.destroy', $supplier));

    $response->assertRedirect(route('suppliers.index'));
    $this->assertSoftDeleted('suppliers', ['id' => $supplier->id]);
});

test('validates required fields on supplier creation', function () {
    $response = $this->post(route('suppliers.store'), []);

    $response->assertSessionHasErrors(['name', 'email']);
});
