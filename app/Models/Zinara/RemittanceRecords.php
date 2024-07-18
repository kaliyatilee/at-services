<?php

namespace App\Models\Zinara;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class RemittanceRecord extends Model
{
    use HasFactory;

    protected $table = "remittance_records";

    protected $fillable = [
        'vehicle_transaction_name'
        'date_of_remittance', => 'array',
        'method_of_remittance' => 'array',
        'amount_remitted_zig', => 'array',
        'amount_remitted_usd', => 'array',
        'account_balance_zig', => 'array',
        'account_balance_usd' => 'array',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expiry_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
