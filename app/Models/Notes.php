<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $table = "notes";

    protected $fillable = [
      "notes",
      "date"
    ];

	public function currency(){
        $currency = Currency::find($this->currency_id);
        if($currency == null){
            $currency = new Currency();
        }

        return $currency;
    }
}
