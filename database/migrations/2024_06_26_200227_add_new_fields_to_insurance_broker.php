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
            $table->date("date_of_remittance")->nullable();
            $table->string("method_of_remittance");
            $table->float("amount_remitted");
            $table->float("account_balance");
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
            Schema::dropIfExists('insurance_brooker');
        });
    }
};
