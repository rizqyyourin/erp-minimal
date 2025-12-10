<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'cost',
        'stock',
        'category',
        'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost' => 'decimal:2',
        'stock' => 'integer',
    ];

    protected $appends = ['status'];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function getStatusAttribute()
    {
        if ($this->stock < 5) {
            return 'critical';
        }
        if ($this->stock <= 10) {
            return 'low_stock';
        }
        return 'active';
    }
}
