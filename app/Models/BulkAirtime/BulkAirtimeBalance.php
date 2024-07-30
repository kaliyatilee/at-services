<?php

namespace App\Models\BulkAirtime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkAirtimeBalance extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "bulk_airtime_balance";
    protected $fillable = [
        'current_balance',
        'description'
    ];

}
