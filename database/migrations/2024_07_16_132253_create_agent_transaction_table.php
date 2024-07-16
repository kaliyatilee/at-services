<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(
			'agent_transaction',
			function ( Blueprint $table ) {
				$table->id();
				$table->string( 'name' );
				$table->float( 'amount_remmited' );
				$table->float( 'account_balance' );
				$table->integer( 'created_by' );
				$table->timestamps();
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'agent_transaction' );
	}
};
