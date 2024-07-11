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
            $table->dropColumn([
                'date_of_remittance',
                'method_of_remittance',
                'amount_remitted',
                'account_balance'
            ]);
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
            //
        });
    }
};
