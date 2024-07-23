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
        Schema::create('clients_credit_authorized', function (Blueprint $table) {
            $table->string("id_number",20)->unique();
            $table->string("name",50);
            $table->string("phone1",20);
            $table->string("phone2",20)->nullable();
            $table->string("address",20);
            $table->string("collateral",20);
            $table->string("guarantor_name",20);
            $table->string("guarantor_phone1",20);
            $table->string("guarantor_phone2",20)->nullable();
            $table->string("guarantor_address",60);
            $table->string("notes",180);
            $table->string("national_id");
            $table->string("proof_of_residence");
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
        Schema::dropIfExists('clients_credit_authorized');
    }
};
