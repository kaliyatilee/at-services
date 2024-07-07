<?php

namespace App\Models\GeneralSales;

use App\Models\Currency;
use App\Models\SalesTransactionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralSale extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $table = "general_sales";

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function curr(){
        return $this->belongsTo(Currency::class, 'currency', 'id');
    }

    public function type()
    {
        return $this->belongsTo(SalesTransactionType::class, 'transaction_type', 'sale_transaction_type_id');
    }

    public function transactionType(){
        $transactionType = GeneralSaleTransactionType::find($this->transaction_type);
        if($transactionType == null){
            $transactionType = new GeneralSaleTransactionType();
        }

        return $transactionType;
    }
}
