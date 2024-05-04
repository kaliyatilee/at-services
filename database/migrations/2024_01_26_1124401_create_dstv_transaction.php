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
        Schema::create('dstv_transaction', function (Blueprint $table) {
            $table->id();
            $table->string("user_id",20);
            $table->string("dstv_account_number");
            $table->integer("package_id");
            $table->float("rand_usd_rate");
            $table->float("balance");
            $table->integer("created_by");
            $table->float("commission_usd");
            $table->text("notes");
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
        Schema::dropIfExists('dstv_transaction');
    }
};
