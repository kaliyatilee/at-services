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
        Schema::create('drink_sales', function (Blueprint $table) {
            $table->id();
            $table->string('drink_sale_id');
            $table->string('drink_id');

            $table->string('date');
            $table->string('description');
            $table->string('notes');
            $table->string('name');
            $table->string('phone');
            $table->string('currency_id');
            $table->string('rate');
            $table->string('amount_paid');
            $table->string('payment_type');
            $table->string('quantity');
            $table->string('expense_name')->nullable();
            $table->string('expense_amount')->nullable();
            $table->string('commission_amount')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('drink_sales');
    }
};
