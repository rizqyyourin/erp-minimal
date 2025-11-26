<?php

use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can list inventory transactions', function () {
    $product = Product::factory()->create(['tenant_id' => $this->tenant->id]);
    
    InventoryTransaction::factory(5)->create([
        'tenant_id' => $this->tenant->id,
        'product_id' => $product->id,
    ]);

    $response = $this->get(route('inventory.index'));

    $response->assertStatus(200);
    $response->assertViewHas('transactions');
});

test('can adjust stock in', function () {
    $product = Product::factory()->create([
        'tenant_id' => $this->tenant->id,
        'stock' => 50,
    ]);

    $adjustData = [
        'product_id' => $product->id,
        'qty' => 10,
        'type' => 'in',
        'notes' => 'Restock from supplier',
    ];

    $response = $this->post(route('inventory.adjust'), $adjustData);

    $response->assertRedirect();
    expect($product->fresh()->stock)->toBe(60);
    
    $this->assertDatabaseHas('inventory_transactions', [
        'product_id' => $product->id,
        'qty' => 10,
        'type' => 'in',
    ]);
});

test('can adjust stock out', function () {
    $product = Product::factory()->create([
        'tenant_id' => $this->tenant->id,
        'stock' => 50,
    ]);

    $adjustData = [
        'product_id' => $product->id,
        'qty' => -10,
        'type' => 'out',
        'notes' => 'Damaged goods',
    ];

    $response = $this->post(route('inventory.adjust'), $adjustData);

    $response->assertRedirect();
    expect($product->fresh()->stock)->toBe(40);
    
    $this->assertDatabaseHas('inventory_transactions', [
        'product_id' => $product->id,
        'qty' => -10,
        'type' => 'out',
    ]);
});

test('can adjust stock to specific value', function () {
    $product = Product::factory()->create([
        'tenant_id' => $this->tenant->id,
        'stock' => 50,
    ]);

    $adjustData = [
        'product_id' => $product->id,
        'qty' => 100,
        'type' => 'adjust',
        'notes' => 'Physical count correction',
    ];

    $response = $this->post(route('inventory.adjust'), $adjustData);

    $response->assertRedirect();
    expect($product->fresh()->stock)->toBe(100);
    
    $this->assertDatabaseHas('inventory_transactions', [
        'product_id' => $product->id,
        'qty' => 100, // Final stock value for 'adjust' type
        'type' => 'adjust',
    ]);
});

test('cannot adjust stock below zero', function () {
    $product = Product::factory()->create([
        'tenant_id' => $this->tenant->id,
        'stock' => 10,
    ]);

    $adjustData = [
        'product_id' => $product->id,
        'qty' => -20,
        'type' => 'out',
    ];

    $response = $this->post(route('inventory.adjust'), $adjustData);

    $response->assertSessionHasErrors();
    expect($product->fresh()->stock)->toBe(10); // Stock unchanged
});

test('can filter transactions by type', function () {
    $product = Product::factory()->create(['tenant_id' => $this->tenant->id]);
    
    InventoryTransaction::factory()->create([
        'tenant_id' => $this->tenant->id,
        'product_id' => $product->id,
        'type' => 'in',
    ]);
    
    InventoryTransaction::factory()->create([
        'tenant_id' => $this->tenant->id,
        'product_id' => $product->id,
        'type' => 'out',
    ]);

    $response = $this->get(route('inventory.index', ['type' => 'in']));

    $response->assertStatus(200);
});

test('can filter transactions by product', function () {
    $product1 = Product::factory()->create(['tenant_id' => $this->tenant->id]);
    $product2 = Product::factory()->create(['tenant_id' => $this->tenant->id]);
    
    InventoryTransaction::factory()->create([
        'tenant_id' => $this->tenant->id,
        'product_id' => $product1->id,
    ]);
    
    InventoryTransaction::factory()->create([
        'tenant_id' => $this->tenant->id,
        'product_id' => $product2->id,
    ]);

    $response = $this->get(route('inventory.index', ['product_id' => $product1->id]));

    $response->assertStatus(200);
});
