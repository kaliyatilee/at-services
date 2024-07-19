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
        Schema::table('remittance_record', function (Blueprint $table) {
            $table->decimal('expected_amount_zig')->nullable();
            $table->decimal('expected_amount_usd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remittance_record', function (Blueprint $table) {
            //
        });
    }
};
