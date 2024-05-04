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
        Schema::create('rtgs', function (Blueprint $table) {
            $table->id();
            $table->integer("type")->comment("1 = amount in, 2 is amount out");
            $table->float("amount",50);
            $table->string("name");
            $table->string("phone");
            $table->longText("notes")->nullable();
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
        Schema::dropIfExists('rtgs');
    }
};
