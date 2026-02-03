<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public const STOCK_CRITICAL_THRESHOLD = 5;

    public const STOCK_LOW_THRESHOLD = 10;

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
        if ($this->stock < self::STOCK_CRITICAL_THRESHOLD) {
            return 'critical';
        }
        if ($this->stock <= self::STOCK_LOW_THRESHOLD) {
            return 'low_stock';
        }

        return 'active';
    }

    public function scopeByStockStatus($query, string $status)
    {
        return match ($status) {
            'low_stock' => $query->where('stock', '<=', self::STOCK_LOW_THRESHOLD),
            'critical' => $query->where('stock', '<', self::STOCK_CRITICAL_THRESHOLD),
            default => $query,
        };
    }
}
