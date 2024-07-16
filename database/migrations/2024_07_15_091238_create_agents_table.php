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
		Schema::dropIfExists( 'agents' );
		Schema::create(
			'agents',
			function ( Blueprint $table ) {
				$table->id();
				$table->string( 'name' );
				$table->string( 'phone' )->nullable();
				$table->date( 'transaction_date' );
				$table->float( 'sales' );
				$table->text( 'description' );
				$table->longText( "notes" )->nullable();
				$table->float( 'amount_to_be_remitted' )->default( '0.0' );
				$table->string( 'currency' );
				$table->text( "rate" )->nullable();
				$table->string( 'payment_type' );
				$table->float(
					"amount_paid",
					20
				);
				$table->float( 'account_balance' );
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
		Schema::dropIfExists( 'agents' );
	}
};
