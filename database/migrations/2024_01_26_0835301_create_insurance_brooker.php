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
        Schema::create('insurance_brooker', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("created_by");
            $table->float("commission");
            $table->text("notes");
            $table->json('remittance')->nullable();
            $table->json('date_of_remittance')->nullable();
            $table->json('method_of_remittance')->nullable();
            $table->json('amount_remitted')->nullable();
            $table->json('account_balance')->nullable();
            $table->float("total_remittance");
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
        Schema::dropIfExists('insurance_brooker');
    }
};
