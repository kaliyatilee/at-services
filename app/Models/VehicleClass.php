<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleClass extends Model
{
    protected $table = "vehicle_class";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'name',
        'currency_id',
        'amount',
    ];

    public function currency(){
        $currency = Currency::find($this->currency_id);
        if($currency == null){
            $currency = new Currency();
        }

        return $currency;
    }
}
