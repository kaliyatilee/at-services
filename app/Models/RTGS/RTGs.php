<?php

namespace App\Models\RTGS;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RTGs extends Model
{
    use HasFactory;
    protected $fillable = [
      'transaction_type',
      'description',
      'amount',
      'expected_amount',
      'rate',
      'name',
      'phone',
      'notes',
      'created_by'
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $table = "rtgs";

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function transactionType(){
        $transactionType = $this->type == 1 ? "Amount In" : "Amount Out";

        return $transactionType;
    }
}
