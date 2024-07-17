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
        Schema::create('dry_cleaning_services_sales_book', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_date')->required()->comment('Date of the transaction');
            $table->text('description')->required()->comment('Description of the transaction');
            $table->longText('notes')->nullable()->comment('Additional notes about the transaction');
            $table->string('full_name', 80)->required()->comment('Full name of the customer');
            $table->string('provider', 80)->required()->comment('Name of the service provider');
            $table->string('phone', 20)->required()->comment('Phone number of the customer');
            $table->unsignedInteger('currency')->required()->comment('Currency used for the transaction');
            $table->decimal('rate', 10, 2)->required()->comment('Exchange rate');
            $table->decimal('amount_paid', 10, 2)->comment('Amount paid by the customer');
            $table->string('payment_type')->required()->comment('Type of payment (e.g. cash, credit card)');
            $table->string('expense_name')->nullable()->comment('Name of the expense (if any)');
            $table->decimal('expense_amount', 10, 2)->default(0.00)->comment('Amount of the expense (if any)');
            $table->decimal('commission_percentage', 10, 2)->required()->comment('Commission percentage');
            $table->decimal('remittance_usd', 10, 2)->nullable()->comment('Remittance in USD');
            $table->decimal('commission_usd', 10, 2)->nullable()->comment('Commission in USD');
            $table->timestamps();
        });

        Schema::create('dry_cleaning_services_remittances_book', function (Blueprint $table) {
            $table->id();
            $table->date('remittance_date')->required()->comment('Date of the remittance transaction');
            $table->unsignedInteger('provider_remitted_to')->required()->comment('Name of provider remitted');
            $table->string('remittance_method')->required()->comment('Method for remittance transaction');
            $table->decimal('amount_remitted', 10, 2)->required()->comment('Amount remitted');
            $table->decimal('account_balance', 10, 2)->required()->comment('Remittences balances');
            $table->timestamps();
        });

        Schema::create('dry_cleaning_services_providers', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->required()->comment('Name of provider');
            $table->longText('description')->nullable()->comment('Provider description');
            $table->string('phone')->required()->comment('Provider phone');
            $table->text('address')->nullable()->comment('Provider address');
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
        Schema::dropIfExists('dry_cleaning_services_sales_book');
        Schema::dropIfExists('dry_cleaning_services_remittances_book');
        Schema::dropIfExists('dry_cleaning_services_providers');

    }
};
