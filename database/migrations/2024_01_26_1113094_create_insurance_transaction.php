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
            $table->integer("created_by");
            $table->integer("class");
            $table->integer("insurance_broker");
            $table->string("reg_no");
            $table->string("user_id",20);
            $table->date("expiry_date");
            $table->date("payment_date")->nullable();
            $table->float("amount");
            $table->float("balance");
            $table->text("notes")->nullable();
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
