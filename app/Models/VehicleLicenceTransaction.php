<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLicenceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_transaction',
        'name',
        'phone',
        'currency',
        'rate',
        'notes',
        'registration_number',
        'expiry_date',
        'transaction_type',
        'vehicle_class',
        'amount_paid_zig',
        'amount_paid_usd',
        'expected_amount_zig',
        'expected_amount_usd',
    ];

    protected $casts = [
        'date_of_transaction' => 'date',
        'expiry_date' => 'date',
        'rate' => 'decimal:2',
        'amount_paid_zig' => 'decimal:2',
        'amount_paid_usd' => 'decimal:2',
        'expected_amount_zig' => 'decimal:2',
        'expected_amount_usd' => 'decimal:2',
    ];
}
