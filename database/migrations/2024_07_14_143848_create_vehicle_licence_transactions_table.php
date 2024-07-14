<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehicle_licence_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_transaction');
            $table->string('name');
            $table->string('phone');
            $table->string('currency');
            $table->decimal('rate', 8, 2);
            $table->text('notes')->nullable();
            $table->string('registration_number');
            $table->date('expiry_date');
            $table->string('transaction_type');
            $table->string('vehicle_class');
            $table->decimal('amount_paid_zig', 10, 2);
            $table->decimal('amount_paid_usd', 10, 2);
            $table->decimal('expected_amount_zig', 10, 2);
            $table->decimal('expected_amount_usd', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_licence_transactions');
    }
};
