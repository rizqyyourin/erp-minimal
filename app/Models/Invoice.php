<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'invoice_number',
        'title',
        'reference',
        'subtotal',
        'discount',
        'tax',
        'total',
        'status',
        'due_date',
        'payment_method',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'due_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }

    protected static function booted()
    {
        static::creating(function ($invoice) {
            if (!$invoice->invoice_number) {
                $lastInvoice = Invoice::withoutGlobalScopes()
                    ->orderBy('id', 'desc')
                    ->first();
                
                $lastNumber = $lastInvoice ? (int) substr($lastInvoice->invoice_number, 4) : 0;
                $invoice->invoice_number = 'INV-' . str_pad(
                    $lastNumber + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );
            }
        });

        // Cascade soft deletes to items and payments
        static::deleting(function ($invoice) {
            if ($invoice->isForceDeleting()) {
                $invoice->items()->forceDelete();
                $invoice->payments()->forceDelete();
            } else {
                $invoice->items()->delete();
                $invoice->payments()->delete();
            }
        });

        // Restore items and payments when invoice is restored
        static::restoring(function ($invoice) {
            $invoice->items()->withTrashed()->restore();
            $invoice->payments()->withTrashed()->restore();
        });
    }
}
