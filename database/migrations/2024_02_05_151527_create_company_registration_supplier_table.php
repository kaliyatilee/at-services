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
        Schema::create('company_registration_supplier', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("phone1",15);
            $table->string("phone2",15)->nullable();
            $table->string("email",40)->nullable();
            $table->string("location",40)->nullable();
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
        Schema::dropIfExists('company_registration_supplier');
    }
};
