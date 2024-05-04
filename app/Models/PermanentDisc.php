<?php

namespace App\Models;

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
    ];

    public function currency(){
        $currency = Currency::find($this->currency);
        if($currency == null){
            $currency = new Currency();
        }

        return $currency;
    }

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }
}
