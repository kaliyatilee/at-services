<?php
namespace App\Models\PrintingServices;

use Illuminate\Database\Eloquent\Model;

class PrintingSales extends Model
{

    protected $table = 'printing_sales_transactions';

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
        'commission_percentage',
        'commission_usd',
    ];
    

}
