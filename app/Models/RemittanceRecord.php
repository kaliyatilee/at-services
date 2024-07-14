<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemittanceRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_of_remittance',
        'method_of_remittance',
        'amount_remitted_zig',
        'amount_remitted_usd',
        'account_balance_zig',
        'account_balance_usd',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_of_remittance' => 'date',
        'amount_remitted_zig' => 'decimal:2',
        'amount_remitted_usd' => 'decimal:2',
        'account_balance_zig' => 'decimal:2',
        'account_balance_usd' => 'decimal:2',
    ];
}
