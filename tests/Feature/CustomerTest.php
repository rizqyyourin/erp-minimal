<?php

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can list customers', function () {
    Customer::factory(5)->create(['tenant_id' => $this->tenant->id]);

    $response = $this->get(route('customers.index'));

    $response->assertStatus(200);
    $response->assertViewHas('customers');
});

test('can create customer', function () {
    $customerData = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '08123456789',
        'address' => 'Jl. Test No. 123',
    ];

    $response = $this->post(route('customers.store'), $customerData);

    $response->assertRedirect(route('customers.index'));
    $this->assertDatabaseHas('customers', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'tenant_id' => $this->tenant->id,
    ]);
});

test('can update customer', function () {
    $customer = Customer::factory()->create([
        'tenant_id' => $this->tenant->id,
        'name' => 'Old Name',
    ]);

    $response = $this->put(route('customers.update', $customer), [
        'name' => 'New Name',
        'email' => $customer->email,
        'phone' => '08123456789',
    ]);

    $response->assertRedirect(route('customers.index'));
    $this->assertDatabaseHas('customers', [
        'id' => $customer->id,
        'name' => 'New Name',
    ]);
});

test('can delete customer', function () {
    $customer = Customer::factory()->create([
        'tenant_id' => $this->tenant->id,
    ]);

    $response = $this->delete(route('customers.destroy', $customer));

    $response->assertRedirect(route('customers.index'));
    $this->assertSoftDeleted('customers', ['id' => $customer->id]);
});

test('can view customer with invoices', function () {
    $customer = Customer::factory()->create(['tenant_id' => $this->tenant->id]);
    
    Invoice::factory()->count(3)->sequence(
        ['invoice_number' => 'INV-0001'],
        ['invoice_number' => 'INV-0002'],
        ['invoice_number' => 'INV-0003'],
    )->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => $customer->id,
    ]);

    $response = $this->get(route('customers.show', $customer));

    $response->assertStatus(200);
    $response->assertViewHas('customer');
});

test('validates email on customer creation', function () {
    $response = $this->post(route('customers.store'), [
        'name' => 'Test Customer',
        'email' => 'invalid-email',
    ]);

    $response->assertSessionHasErrors(['email']);
});
