<?php

namespace App\Models\GeneralSales;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSale extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'currency',
        'transaction_type',
        'amount',
        'payment_type',
        'created_by',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $table = "general_sales";
    use HasFactory;

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function currency(){
        $currency = Currency::find($this->currency);
        if($currency == null){
            $currency = new Currency();
        }

        return $currency;
    }

    public function transactionType(){
        $transactionType = GeneralSaleTransactionType::find($this->transaction_type);
        if($transactionType == null){
            $transactionType = new GeneralSaleTransactionType();
        }

        return $transactionType;
    }
}
