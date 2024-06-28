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
        Schema::table('general_sales', function (Blueprint $table) {
            $table->dropColumn('transaction_type');
        });

        Schema::table('general_sales', function (Blueprint $table) {
            $table->string('transaction_type');
        });

        Schema::table('general_sales', function (Blueprint $table) {
            $table->dropColumn('amount');
        });

        Schema::table('general_sales', function (Blueprint $table) {
            $table->string('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_sales', function (Blueprint $table) {
//            $table->string('transaction_type');
//            $table->string('amount');
        });
    }
};
