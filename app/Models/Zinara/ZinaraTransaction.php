<?php

namespace App\Models\Zinara;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleClass;
use App\Models\User;
use App\Models\RemittanceRecord; // Include RemittanceRecord model

class ZinaraTransaction extends Model
{
    protected $table = "zinara_transaction";
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expiry_date' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'created_by',
        'vehicle_class',
        'name',
        'phone',
        'rate',
        'reg_no',
        'expiry_date',
        'notes',
        'amount_paid',
        'expected_amount',
        'date_of_transaction',
        'currency',
        'transaction_type',
        'amount_paid_zig',
        'expected_amount_zig',
        'remittance_table'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getVehicleClass()
    {
        return VehicleClass::find($this->vehicle_class);
    }

    public function getPayments()
    {
        return InsurancePayment::where("insurance_transaction_id", $this->id)->get();
    }

    public function remittanceRecord()
    {
        return $this->belongsTo(RemittanceRecord::class, 'remittance_record_id');
    }
}
