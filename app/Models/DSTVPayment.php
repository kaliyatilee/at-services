<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSTVPayment extends Model
{
    protected $table = "dstv_payment";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
        "currency",
        "dstv_transaction_id",
        "amount",
        "amount_before",
        "amount_after",
        "created_by",
        "notes"
    ];
}
