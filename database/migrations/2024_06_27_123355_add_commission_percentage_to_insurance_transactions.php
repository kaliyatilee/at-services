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
            if (!Schema::hasColumn('insurance_transaction', 'amount_received_usd')) {
                $table->float("amount_received_usd");
            }
            if (!Schema::hasColumn('insurance_transaction', 'amount_received_zig')) {
                $table->float("amount_received_zig");
            }
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
            if (Schema::hasColumn('insurance_transaction', 'amount_received_usd')) {
                $table->dropColumn('amount_received_usd');
            }
            if (Schema::hasColumn('insurance_transaction', 'amount_received_zig')) {
                $table->dropColumn('amount_received_zig');
            }
        });
    }
};
