<?php
namespace App\Models\UnifiedTransactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnifiedTransactions extends Model
{
    protected $table = "unified_transactions";
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'transaction_date',
        'description',
        'notes',
        'full_name',
        'phone',
        'currency',
        'rate',
        'amount_paid',
        'model',
        'payment_type'
    ];
}