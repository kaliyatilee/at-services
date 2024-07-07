<?php

namespace App\Models\Ecocash;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecocash extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'currency',
        'agent_line',
        'transaction_type',
        'expected_amount',
        'amount_paid',
        'created_by',
		'transaction_date',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $table = "ecocash";
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

    public function curr(){
        return $this->belongsTo(Currency::class, 'currency');
    }

    public function transactionType(){
        $ecocashTransactionType = EcocashTransactionType::find($this->transaction_type);
        if($ecocashTransactionType == null){
            $ecocashTransactionTypene = new EcocashTransactionType();
        }

        return $ecocashTransactionType;
    }

    public function agentLine(){
        $agentLine = EcocashAgentLine::find($this->agent_line);
        if($agentLine == null){
            $agentLine = new EcocashAgentLine();
        }

        return $agentLine;
    }
}
