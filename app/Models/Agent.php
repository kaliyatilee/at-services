<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model {
	use HasFactory;

	protected $casts = [
		'created_at' => 'date:Y-m-d H:i:s',
		'updated_at' => 'date:Y-m-d H:i:s',
	];

	protected $fillable = [
		"name",
		"phone",
		"currency",
		"rate",
		"sales",
		"payment_type",
		"amount_paid",
		"transaction_date",
		"account_balance",
		"notes",
		"description"
	];
	use HasFactory;
}
