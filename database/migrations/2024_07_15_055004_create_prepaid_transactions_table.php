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
        Schema::create('prepaid_transactions', function (Blueprint $table) {
            $table->id(); // id auto increment
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->integer('currency_id');
            $table->double('rate', 15, 8);
            $table->integer('transaction_type')->default(13)->nullable()->change();
            $table->double('amount', 15, 8);
            $table->string('description', 255)->nullable();
            $table->longText('notes')->nullable();
            $table->integer('created_by');
            $table->date('transaction_date');
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prepaid_transactions');
    }
};
