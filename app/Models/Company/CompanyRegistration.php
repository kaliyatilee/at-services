<?php

namespace App\Models\Company;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRegistration extends Model
{

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
        'payment_date' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
      'supplier',
      'name',
      'phone',
      'charge',
      'expenses',
      'currency_id',
      'amount_paid',
      'commission',
      'created_by',
      'notes',
	  'transaction_date'
    ];
    protected $table = "company_registration";
    use HasFactory;

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }

    public function supplier(){
        $companyRegistrationSupplier = CompanyRegistrationSupplier::find($this->created_by);
        if($companyRegistrationSupplier == null){
            $companyRegistrationSupplier = new CompanyRegistrationSupplier();
        }

        return $companyRegistrationSupplier;
    }

	// public function currency(){
    //     $currency = Currency::find($this->currency);
    //     if($currency == null){
    //         $currency = new Currency();
    //     }

    //     return $currency;
    // }
}
