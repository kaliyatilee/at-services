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
        Schema::table('zinara_transaction', function (Blueprint $table) {
            $table->date('date_of_transaction')->nullable();
            $table->string('currency')->nullable();
            $table->string('transaction_type')->nullable();
            $table->decimal('amount_pid_zig', 15, 2)->nullable();
            $table->decimal('expected_amount_zig', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zinara_transaction', function (Blueprint $table) {
            $table->dropColumn('date_of_transaction');
            $table->dropColumn('currency');
            $table->dropColumn('transaction_type');
            $table->dropColumn('amount_pid_zig');
            $table->dropColumn('expected_amount_zig');
        });
    }
};
