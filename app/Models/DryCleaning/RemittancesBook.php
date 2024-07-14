<?php

namespace App\Models\DryCleaning;

use Illuminate\Database\Eloquent\Model;

class RemittancesBook extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dry_cleaning_services_remittances_book';

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
        'remittance_date',
        'provider_remitted_to',
        'remittance_method',
        'amount_remitted',
        'account_balance'
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
        'remittance_date' => 'date',
        'amount_remitted' => 'decimal:2',
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
    protected $dates = ['remittance_date'];
}