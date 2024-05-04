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
        Schema::create('loan_disbursed', function (Blueprint $table) {
            $table->id();
            $table->string("user_id",20);
            $table->float("amount");
            $table->float("balance");
            $table->float("rate_per_week");
            $table->date("repayment_date");
            $table->string("collateral");
            $table->integer("created_by");
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
        Schema::dropIfExists('loan_disbursed');
    }
};
