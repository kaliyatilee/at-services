<?php

namespace App\Models\Zinara;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class RemittanceRecord extends Model
{
    use HasFactory;

    protected $table = "remittance_record";

    protected $fillable = [
        'vehicle_transaction_name',
        'date_of_remittance',
        'method_of_remittance',
        'amount_remitted_zig',
        'amount_remitted_usd',
        'account_balance_zig',
        'account_balance_usd',
        'expected_amount_zig',
        'expected_amount_usd'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expiry_date' => 'datetime:Y-m-d H:i:s',
        'date_of_remittance' => 'array',
        'method_of_remittance' => 'array',
        'amount_remitted_zig' => 'array',
        'amount_remitted_usd' => 'array',
        'account_balance_zig' => 'array',
        'account_balance_usd' => 'array',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDateOfRemittanceAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function getMethodOfRemittanceAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function getAmountRemittedZigAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function getAmountRemittedUsdAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function getAccountBalanceZigAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function getAccountBalanceUsdAttribute($value)
    {
        return is_array($value) ? $value : json_decode($value, true);
    }

    public function setDateOfRemittanceAttribute($value)
    {
        $this->attributes['date_of_remittance'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setMethodOfRemittanceAttribute($value)
    {
        $this->attributes['method_of_remittance'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setAmountRemittedZigAttribute($value)
    {
        $this->attributes['amount_remitted_zig'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setAmountRemittedUsdAttribute($value)
    {
        $this->attributes['amount_remitted_usd'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setAccountBalanceZigAttribute($value)
    {
        $this->attributes['account_balance_zig'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setAccountBalanceUsdAttribute($value)
    {
        $this->attributes['account_balance_usd'] = is_array($value) ? json_encode($value) : $value;
    }
}