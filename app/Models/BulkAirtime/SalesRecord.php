<?php

namespace App\Models\BulkAirtime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRecord extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "bulk_airtime_sales_record";
    protected $fillable = [
        'transaction_date',
        'description',
        'notes',
        'full_name',
        'phone',
        'currency',
        'rate',
        'amount_paid',
        'payment_type',
        'percentage',
        'commission_usd',
    ];

}
