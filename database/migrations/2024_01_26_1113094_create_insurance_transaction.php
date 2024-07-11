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
        Schema::create('insurance_transaction', function (Blueprint $table) {
            $table->id();
            $table->text("name")->nullable();
            $table->text("phone")->nullable();
            $table->text("vehicle_type")->nullable();
            $table->integer("created_by");
            $table->integer("currency_id");
            $table->integer("class");
            $table->integer("insurance_broker");
            $table->string("reg_no");
            $table->date("expiry_date");
            $table->date("payment_date")->nullable();
            $table->date("received_date")->nullable();
            $table->float("expected_amount_zig");
            $table->float("commission_amount");
            $table->float("amount_remitted_usd");
            $table->float("amount_remitted_zig");
            $table->float("commission_percentage");
            $table->float("amount_received_usd");
            $table->float("amount_received_zig");
            $table->text("notes")->nullable();
            $table->text("rate")->nullable();
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
        Schema::dropIfExists('insurance_transaction');
    }
};
