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
        Schema::create('dstv_transaction', function (Blueprint $table) {
            $table->id();
            $table->string("name")->required();
            $table->string("phone")->required();
            $table->string("dstv_account_number")->required();
            $table->string("description");
            $table->integer("system_charges")->required();
            $table->integer("system_charge_amount")->required();
            $table->integer("package")->required();
            $table->integer("currency")->required();
            $table->decimal("expected_amount", 10,2);
            $table->decimal("amount_paid", 10,2)->required();
            $table->decimal("amount_paid_usd", 10,2);
            $table->decimal("commission_usd", 10,2);
            $table->decimal("rate", 10,2)->required();
            $table->date("transaction_date")->required();
            $table->text("notes")->nullable();
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
        Schema::dropIfExists('dstv_transaction');
    }
};
