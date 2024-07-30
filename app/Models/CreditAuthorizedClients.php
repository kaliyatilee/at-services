<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditAuthorizedClients extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $table = "clients_credit_authorized";

    protected $primaryKey = 'id_number';

    protected $fillable = [
        'id_number',
        'name',
        'phone1',
        'phone2',
        'address',
        'collateral',
        'guarantor_name',
        'guarantor_phone1',
        'guarantor_phone2',
        'guarantor_address',
        'national_id',
        'notes',
        'proof_of_residence',
        'created_by',
    ];

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }
}
