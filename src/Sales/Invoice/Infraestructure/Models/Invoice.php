<?php

namespace Src\Sales\Invoice\Infraestructure\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Sales\Order\Infraestructure\Models\Order;

class Invoice extends Model
{
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nit',
        'number',
        'authorization_code',
        'invoice_date',
        'customer_id',
        'customer_code',
        'customer_name',
        'customer_nit',
        'status',
        'total',
        'order_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'invoice_date' => 'immutable_datetime',
        ];
    }

    /**
     * Get the items for the invoice.
     */
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * Get the order that owns the invoice.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
