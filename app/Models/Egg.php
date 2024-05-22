<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    protected $table = "eggs";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
      'name',
      'phone',
      'cash_paid',
      'currency_id',
      'quantity_received',
      'quantity_sold',
      'breakages',
      'order_price',
      'created_by',
      'notes',
	  'transaction_date'
    ];

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }
}
