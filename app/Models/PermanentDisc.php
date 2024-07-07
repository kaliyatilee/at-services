<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermanentDisc extends Model
{
    protected $table = "permanent_disc";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
      'cash_paid',
      'quantity_sold',
      'quantity_received',
      'order_price',
      'currency_id',
      'created_by',
      'notes',
      'name',
      'phone',
	  'transaction_date'
    ];


    public function currency()
    {
        // Check if currency_id is not zero and is not null
        if ($this->currency_id !== 0 && $this->currency_id !== null) {
            // Attempt to find the Currency object by its ID
            $currency = Currency::find($this->currency_id);
            // If Currency object is found, return it
            if ($currency !== null) {
                return $currency;
            }
        }

        // If currency_id is zero or null, or if Currency object is not found, return a new instance of Currency
        return new Currency();
    }



    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function curr()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }
}
