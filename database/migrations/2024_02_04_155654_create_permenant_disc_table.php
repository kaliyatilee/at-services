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
        Schema::create('permanent_disc', function (Blueprint $table) {
            $table->id();
            $table->float("cash_paid",50,2);
            $table->integer("quantity_sold");
            $table->integer("quantity_received");
            $table->integer("currency");
            $table->float("order_price",50,2);
            $table->integer("created_by");
            $table->longText("notes")->nullable();
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
        Schema::dropIfExists('permenant_disc');
    }
};
