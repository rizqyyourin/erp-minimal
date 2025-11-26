<?php

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can list invoices', function () {
    $customer = Customer::factory()->create(['tenant_id' => $this->tenant->id]);
    
    Invoice::factory()->count(5)->sequence(
        ['invoice_number' => 'INV-0001'],
        ['invoice_number' => 'INV-0002'],
        ['invoice_number' => 'INV-0003'],
        ['invoice_number' => 'INV-0004'],
        ['invoice_number' => 'INV-0005'],
    )->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => $customer->id,
    ]);

    $response = $this->get(route('invoices.index'));

    $response->assertStatus(200);
    $response->assertViewHas('invoices');
});

test('can create invoice and reduce stock', function () {
    $customer = Customer::factory()->create(['tenant_id' => $this->tenant->id]);
    $product1 = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 50]);
    $product2 = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 30]);

    $invoiceData = [
        'customer_id' => $customer->id,
        'title' => 'Test Invoice',
        'discount' => 10.00,
        'tax' => 11.00,
        'due_date' => now()->addDays(30)->format('Y-m-d'),
        'payment_method' => 'cash',
        'items' => [
            [
                'product_id' => $product1->id,
                'qty' => 5,
                'price' => 100.00,
            ],
            [
                'product_id' => $product2->id,
                'qty' => 3,
                'price' => 50.00,
            ],
        ],
    ];

    $response = $this->post(route('invoices.store'), $invoiceData);

    $response->assertRedirect();
    
    // Check invoice created
    $this->assertDatabaseHas('invoices', [
        'customer_id' => $customer->id,
        'title' => 'Test Invoice',
    ]);

    // Check stock reduced
    expect($product1->fresh()->stock)->toBe(45);
    expect($product2->fresh()->stock)->toBe(27);

    // Check inventory transactions logged
    $this->assertDatabaseCount('inventory_transactions', 2);
});

test('cannot create invoice with insufficient stock', function () {
    $customer = Customer::factory()->create(['tenant_id' => $this->tenant->id]);
    $product = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 5]);

    $invoiceData = [
        'customer_id' => $customer->id,
        'items' => [
            [
                'product_id' => $product->id,
                'qty' => 10, // More than available
                'price' => 100.00,
            ],
        ],
    ];

    $response = $this->post(route('invoices.store'), $invoiceData);

    $response->assertSessionHasErrors();
    expect($product->fresh()->stock)->toBe(5); // Stock unchanged
});

test('can cancel invoice and revert stock', function () {
    $customer = Customer::factory()->create(['tenant_id' => $this->tenant->id]);
    $product = Product::factory()->create(['tenant_id' => $this->tenant->id, 'stock' => 50]);

    $invoiceData = [
        'customer_id' => $customer->id,
        'due_date' => now()->addDays(30)->format('Y-m-d'),
        'items' => [
            [
                'product_id' => $product->id,
                'qty' => 5,
                'price' => 100.00,
            ],
        ],
    ];

    $response = $this->post(route('invoices.store'), $invoiceData);
    $invoice = Invoice::where('customer_id', $customer->id)->first();

    expect($product->fresh()->stock)->toBe(45);

    // Cancel invoice
    $response = $this->post(route('invoices.cancel', $invoice));

    $response->assertRedirect();
    expect($invoice->fresh()->status)->toBe('cancelled');
    expect($product->fresh()->stock)->toBe(50); // Stock reverted
});

test('can record payment and update invoice status', function () {
    $invoice = Invoice::factory()->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => Customer::factory()->create(['tenant_id' => $this->tenant->id])->id,
        'invoice_number' => 'INV-0001',
        'total' => 1000.00,
        'status' => 'pending',
    ]);

    $paymentData = [
        'amount' => 500.00,
        'method' => 'transfer',
        'paid_at' => now()->format('Y-m-d'),
    ];

    $response = $this->post(route('payments.store', $invoice), $paymentData);

    $response->assertRedirect();
    
    $this->assertDatabaseHas('payments', [
        'invoice_id' => $invoice->id,
        'amount' => 500.00,
        'method' => 'transfer',
    ]);

    expect($invoice->fresh()->status)->toBe('partial');
});

test('invoice status becomes paid when fully paid', function () {
    $invoice = Invoice::factory()->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => Customer::factory()->create(['tenant_id' => $this->tenant->id])->id,
        'invoice_number' => 'INV-0001',
        'total' => 1000.00,
        'status' => 'pending',
    ]);

    $paymentData = [
        'amount' => 1000.00,
        'method' => 'cash',
        'paid_at' => now()->format('Y-m-d'),
    ];

    $this->post(route('payments.store', $invoice), $paymentData);

    expect($invoice->fresh()->status)->toBe('paid');
});

test('can filter invoices by status', function () {
    Invoice::factory()->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => Customer::factory()->create(['tenant_id' => $this->tenant->id])->id,
        'invoice_number' => 'INV-0001',
        'status' => 'paid',
    ]);
    
    Invoice::factory()->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => Customer::factory()->create(['tenant_id' => $this->tenant->id])->id,
        'invoice_number' => 'INV-0002',
        'status' => 'pending',
    ]);

    $response = $this->get(route('invoices.index', ['status' => 'paid']));

    $response->assertStatus(200);
    $response->assertSee('INV-0001');
    $response->assertDontSee('INV-0002');
});

test('cannot delete non-draft invoice', function () {
    $invoice = Invoice::factory()->create([
        'tenant_id' => $this->tenant->id,
        'customer_id' => Customer::factory()->create(['tenant_id' => $this->tenant->id])->id,
        'invoice_number' => 'INV-0001',
        'status' => 'paid',
    ]);

    $response = $this->delete(route('invoices.destroy', $invoice));

    $response->assertRedirect();
    $response->assertSessionHas('error');
    $this->assertDatabaseHas('invoices', ['id' => $invoice->id]);
});
