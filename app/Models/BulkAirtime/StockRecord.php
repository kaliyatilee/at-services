<?php

namespace App\Models\BulkAirtime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRecord extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "bulk_airtime_stock_record";
    protected $fillable = [
        'transaction_date',
        'description',
        'in',
        'out',
        'shortages',
        'balance'
    ];

}
