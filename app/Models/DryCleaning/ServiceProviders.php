<?php

namespace App\Models\DryCleaning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviders extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dry_cleaning_services_providers';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider',
        'description',
        'phone',
        'address',
    ];
}
