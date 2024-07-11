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
        Schema::create('loan_payment', function (Blueprint $table) {
            $table->id();
            $table->integer("loan_id");
            $table->float("amount");
            $table->float("amount_before");
            $table->float("amount_after");
            $table->date("installment_payment_date");
            $table->float("installment_amount_paid");
            $table->float("currency_rate");
            $table->string("expense");
            $table->float("expense_amount");
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
        Schema::dropIfExists('loan_payment');
    }
};
