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
		$user = User::find( $this->created_by );
		if ( $user == null ) {
			$user = new User();
		}

		return $user;
	}
}
