<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDisbursed extends Model
{
    protected $table = "loan_disbursed";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
        'repayment_date' => 'date:Y-m-d H:i:s',
    ];

    protected $guarded = [];

    public function getUser(){
        $user = Client::query()->where("id_number",$this->user_id)->first();
        if($user == null){
            $user = new Client();
        }

        return $user;
    }

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function currency(){
        $currency = Currency::find($this->currency_id);
        if($currency == null){
            $currency = new Currency();
        }

        return $currency;
    }

    public function getPaidAmount(){
        $payments = LoanPayment::query()->where("loan_id",$this->id)->get();

        $paid_amount = 0;
        foreach ($payments as $payment){
            $paid_amount = $paid_amount + $payment->amount;
        }

        return $paid_amount;
    }
    public function getBalance(){
        $paid_amount = $this->getPaidAmount();
        $balance = $this->amount - $paid_amount;

        return $balance;
    }
}
