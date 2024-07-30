<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemCharge extends Model
{
    protected $table = "system_charges";
    use HasFactory;

    protected $fillable = [
        'name'
    ];

}
