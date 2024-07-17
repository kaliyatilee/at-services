<?php

namespace App\Models\DryCleaning;

use Illuminate\Database\Eloquent\Model;

class SalesBook extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dry_cleaning_services_sales_book';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_date',
        'description',
        'provider',
        'notes',
        'full_name',
        'phone',
        'currency',
        'rate',
        'amount_paid',
        'payment_type',
        'expense_name',
        'expense_amount',
        'commission_percentage',
        'remittance_usd',
        'commission_usd',
    ];

   
}