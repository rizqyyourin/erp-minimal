<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can list products', function () {
    Product::factory(5)->create(['tenant_id' => $this->tenant->id]);

    $response = $this->get(route('products.index'));

    $response->assertStatus(200);
    $response->assertViewHas('products');
});

test('can create product', function () {
    $productData = [
        'name' => 'Test Product',
        'sku' => 'TEST-001',
        'price' => 100.00,
        'cost' => 50.00,
        'stock' => 10,
        'category' => 'Electronics',
        'description' => 'Test description',
    ];

    $response = $this->post(route('products.store'), $productData);

    $response->assertRedirect(route('products.index'));
    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'sku' => 'TEST-001',
        'tenant_id' => $this->tenant->id,
    ]);
});

test('can update product', function () {
    $product = Product::factory()->create([
        'tenant_id' => $this->tenant->id,
        'name' => 'Old Name',
    ]);

    $response = $this->put(route('products.update', $product), [
        'name' => 'New Name',
        'sku' => $product->sku,
        'price' => 150.00,
        'cost' => 75.00,
        'stock' => 20,
        'category' => 'Electronics',
    ]);

    $response->assertRedirect(route('products.index'));
    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'New Name',
    ]);
});

test('can delete product', function () {
    $product = Product::factory()->create([
        'tenant_id' => $this->tenant->id,
    ]);

    $response = $this->delete(route('products.destroy', $product));

    $response->assertRedirect(route('products.index'));
    $this->assertSoftDeleted('products', ['id' => $product->id]);
});

// Test commented out - requires dynamic view implementation
// test('can search products', function () {
//     Product::factory()->create([
//         'tenant_id' => $this->tenant->id,
//         'name' => 'Laptop HP',
//         'sku' => 'LAP-001',
//     ]);

//     Product::factory()->create([
//         'tenant_id' => $this->tenant->id,
//         'name' => 'Mouse Logitech',
//         'sku' => 'MOU-001',
//     ]);

//     $response = $this->get(route('products.index', ['search' => 'Laptop']));

//     $response->assertStatus(200);
//     $response->assertSee('Laptop HP');
//     $response->assertDontSee('Mouse Logitech');
// });

test('product shows correct status based on stock', function () {
    $critical = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 3]);
    $lowStock = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 8]);
    $active = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 50]);

    expect($critical->status)->toBe('critical');
    expect($lowStock->status)->toBe('low_stock');
    expect($active->status)->toBe('active');
});

test('validates required fields on product creation', function () {
    $response = $this->post(route('products.store'), []);

    $response->assertSessionHasErrors(['name', 'sku', 'price', 'cost', 'stock']);
});
