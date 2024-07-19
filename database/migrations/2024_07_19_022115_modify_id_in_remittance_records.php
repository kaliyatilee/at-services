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
        Schema::table('remittance_record', function (Blueprint $table) {
            $table->dropPrimary();
            
            // Then modify the id column
            $table->bigIncrements('id')->change();
        });

     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('remittance_record', function (Blueprint $table) {
            $table->integer('id')->change();
        });
    }
};
