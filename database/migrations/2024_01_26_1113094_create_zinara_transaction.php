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
        Schema::create('zinara_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer("created_by");
            $table->integer("class");
            $table->string("name");
            $table->string("phone");
            $table->string("reg_no");
            $table->date("expiry_date");
            $table->float("amount_paid");
            $table->float("amount_owed");
            $table->float("rate");
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
