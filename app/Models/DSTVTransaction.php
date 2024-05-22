<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DSTVTransaction extends Model
{
    protected $table = "dstv_transaction";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'package_id',
        'created_by',
        'rate',
        'amount_paid',
        'commission_usd',
        'notes',
        'name',
        'phone',
        'expected_amount',
        'currency_id',
        'dstv_account_number',
		'transaction_date'
    ];

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

    public function getAmountPaid(){
        $payments = $this->getPayments();
        $amount_paid = 0;
        foreach($payments as $payment){
            $amount_paid += $payment->amount;
        }

        return $amount_paid;
    }

	public function package()
    {
        return $this->belongsTo(DSTVPackage::class, 'package_id');
    }

    public function getPayments(){
        $dstvPayments = DSTVPayment::query()->where("dstv_transaction_id",$this->id)->get();

        return $dstvPayments;
    }

	public function currency(){
        $currency = Currency::find($this->currency_id);
        if($currency == null){
            $currency = new Currency();
        }

        return $currency;
    }
}
