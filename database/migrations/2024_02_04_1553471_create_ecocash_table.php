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
        Schema::create('ecocash', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone");
            $table->integer("currency");
            $table->integer("agent_line");
            $table->integer("transaction_type");
            $table->float("amount",20);
            $table->float("amount_paid",20);
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
        Schema::dropIfExists('ecocash');
    }
};
