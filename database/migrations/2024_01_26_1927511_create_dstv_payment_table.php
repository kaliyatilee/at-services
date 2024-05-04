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
        Schema::create('dstv_payment', function (Blueprint $table) {
            $table->id();
            $table->string("currency",5);
            $table->integer("dstv_transaction_id");
            $table->float("amount");
            $table->float("amount_before");
            $table->float("amount_after");
            $table->integer("created_by");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dstv_payment');
    }
};
