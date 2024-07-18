<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remittance_records', function (Blueprint $table) {
            // Add fields
            $table->string('vehicle_transaction_name')->nullable();
            $table->json('date_of_remittance')->nullable();
            $table->json('method_of_remittance')->nullable();
            $table->json('amount_remitted_zig')->nullable();
            $table->json('amount_remitted_usd')->nullable();
            $table->json('account_balance_zig')->nullable();
            $table->json('account_balance_usd')->nullable();

            // If 'created_by' is a foreign key to users table
            // $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remittance_records', function (Blueprint $table) {
            // Drop added fields
            $table->dropColumn('vehicle_transaction_name');
            $table->dropColumn('date_of_remittance');
            $table->dropColumn('method_of_remittance');
            $table->dropColumn('amount_remitted_zig');
            $table->dropColumn('amount_remitted_usd');
            $table->dropColumn('account_balance_zig');
            $table->dropColumn('account_balance_usd');
        });
    }
};
