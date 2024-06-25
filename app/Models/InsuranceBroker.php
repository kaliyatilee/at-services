<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceBroker extends Model
{
    protected $table = "insurance_brooker";
    use HasFactory;

    protected $casts = [
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'name',
        'commission',
        'notes',
        'created_by'
    ];

	public function createdBy(){
        $user = User::find($this->created_by);
        if($user == null){
            $user = new User();
        }

        return $user;
    }
}
