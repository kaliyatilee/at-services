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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'transaction_date' => 'date',
        'rate' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'expense_amount' => 'decimal:2',
        'commission_percentage' => 'decimal:1',
        'remittance_usd' => 'decimal:2',
        'commission_usd' => 'decimal:2',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['transaction_date'];
}