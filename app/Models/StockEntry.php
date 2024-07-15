<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(SalesTransactionType::class, 'transaction_type', 'sale_transaction_type_id');
    }
}
