<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceTransaction extends Model
{
    protected $table = "insurance_transaction";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
        'expiry_date' => 'date:Y-m-d H:i:s',
    ];

    protected $guarded = [];

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function getUser(){
        $user = Client::query()->where("id_number",$this->user_id)->first();
        if($user == null){
            $user = new Client();
        }

        return $user;
    }

    public function getVehicleClass(){
        $vehicle_class = VehicleClass::query()->where("id",$this->class)->first();
        if($vehicle_class == null){
            $vehicle_class = new VehicleClass();
        }

        return $vehicle_class;
    }

    public function getInsuranceBroker(){
        $insurance_broker = InsuranceBroker::query()->where("id",$this->insurance_broker)->first();
        if($insurance_broker == null){
            $insurance_broker = new InsuranceBroker();
        }

        return $insurance_broker;
    }

    public function getAmountPaid(){
        $payments = $this->getPayments();
        $amount_paid = 0;
        foreach($payments as $payment){
            $amount_paid += $payment->amount;
        }

        return $amount_paid;
    }

    public function getPayments(){
        $dstvPayments = InsurancePayment::query()->where("insurance_transaction_id",$this->id)->get();

        return $dstvPayments;
    }
}
