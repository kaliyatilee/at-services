<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrinkSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function item()
    {
        return $this->belongsTo(Drink::class, 'drink_id', 'drink_id')->withTrashed();
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SalesTransactionType::class, 'payment_type', 'sale_transaction_type_id');
    }
}
