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
        Schema::create('printing_sales_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date')->required()->comment('Date of the transaction');
            $table->text('description')->required()->comment('Description of the transaction');
            $table->longText('notes')->nullable()->comment('Additional notes about the transaction');
            $table->string('full_name', 30)->required()->comment('Full name of the customer');
            $table->string('phone', 20)->required()->comment('Phone number of the customer');
            $table->unsignedInteger('currency')->required()->comment('Currency used for the transaction');
            $table->decimal('rate', 8, 2)->required()->comment('Exchange rate');
            $table->decimal('amount_paid', 8, 2)->comment('Amount paid by the customer');
            $table->decimal('commission', 8, 2)->comment('Amount for commission');
            $table->string('payment_type')->required()->comment('Type of payment (e.g. cash, credit card)');
            $table->decimal('commission_usd', 8, 2)->nullable()->comment('Commission in USD');
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
        Schema::dropIfExists('printing_sales_transactions');
    }
};
