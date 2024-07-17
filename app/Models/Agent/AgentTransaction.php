<?php

namespace App\Models\Agent;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentTransaction extends Model {
	use HasFactory;

	protected $table = "agent_transaction";

	protected $casts = [
		'created_at' => 'date:Y-m-d H:i:s',
		'updated_at' => 'date:Y-m-d H:i:s',
	];

	protected $fillable = [
		"name",
		"amount_remmited",
		"account_balance",
		'created_by'
	];

	public function createdBy() {
		return $this->belongsTo(User::class, 'created_by');
	}

	public function agent() {
		return $this->belongsTo(Agent::class, 'name', 'name');
	}

	public function calculateAccountBalance() {
		$totalAmountPaid = $this->agent->amount_paid->sum();
		$totalAmountRemitted = $this->agent->transactions->sum('amount_remmited');

		return $totalAmountPaid - $totalAmountRemitted;
	}

}
