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
    
}