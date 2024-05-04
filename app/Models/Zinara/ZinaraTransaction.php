<?php

namespace App\Models\Zinara;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZinaraTransaction extends Model
{
    protected $table = "zinara_transaction";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
        'expiry_date' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable =
        [
            'created_by',
            'class',
            'name',
            'phone',
            'rate',
            'reg_no',
            'expiry_date',
            'notes',
            'amount_paid',
            'expected_amount'
        ];

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
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

    public function getPayments(){
        $dstvPayments = InsurancePayment::query()->where("insurance_transaction_id",$this->id)->get();

        return $dstvPayments;
    }
}
