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
        Schema::create('general_sales', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->integer("currency");
            $table->integer("transaction_type");
            $table->float("amount",20);
            $table->integer("created_by");
            $table->longText("notes")->nullable();
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
        Schema::dropIfExists('general_sales');
    }
};
