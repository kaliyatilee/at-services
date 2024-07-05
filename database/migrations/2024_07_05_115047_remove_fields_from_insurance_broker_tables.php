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
        Schema::table('insurance_brooker', function (Blueprint $table) {
            $table->json('remittance')->nullable();
            $table->json('date_of_remittance')->nullable();
            $table->json('method_of_remittance')->nullable();
            $table->json('amount_remitted')->nullable();
            $table->json('account_balance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_brooker', function (Blueprint $table) {
            $table->dropColumn('remittance');
            $table->dropColumn('date_of_remittance');
            $table->dropColumn('method_of_remittance');
            $table->dropColumn('amount_remitted');
            $table->dropColumn('account_balance');
        });
    }
};
