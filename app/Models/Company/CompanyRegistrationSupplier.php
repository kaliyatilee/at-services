<?php

namespace App\Models\Company;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRegistrationSupplier extends Model
{

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $table = "company_registration_supplier";
    use HasFactory;
    protected $fillable = [
      "name",
      "phone1",
      "phone2",
      "email",
      "location",
      "created_by",
      "notes",
    ];

    public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }
}
