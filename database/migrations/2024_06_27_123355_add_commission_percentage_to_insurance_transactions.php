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
            $table->float("amount_received_usd");
            $table->float("amount_received_zig");
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
