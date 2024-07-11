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
        Schema::table('insurance_transaction', function (Blueprint $table) {
            $table->date("received_date")->nullable();
            $table->float("expected_amount_zig");
            $table->float("commission_amount");
            $table->float("amount_paid_zig");
            $table->float("amount_remitted_usd");
            $table->float("amount_remitted_zig");
            $table->float("commission_percentage");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_transaction', function (Blueprint $table) {
            Schema::dropIfExists('insurance_transaction');
        });
    }
};
