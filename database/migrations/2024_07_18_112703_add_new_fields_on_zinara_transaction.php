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
        Schema::table('zinara_transaction', function (Blueprint $table) {
            // Remove the 'class' field if it exists
            if (Schema::hasColumn('zinara_transaction', 'class')) {
                $table->dropColumn('class');
            }

            // Add the 'vehicle_class' field
            $table->unsignedBigInteger('vehicle_class')->nullable();

            // Add foreign key constraint if 'vehicle_class' is intended to reference another table
            // $table->foreign('vehicle_class')->references('id')->on('vehicle_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zinara_transaction', function (Blueprint $table) {
            // Reverse the operations in 'up' method if needed
            $table->unsignedBigInteger('class')->nullable();

            // Drop the 'vehicle_class' field
            $table->dropColumn('vehicle_class');
        });
    }
};
