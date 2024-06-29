<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('sales_transaction_types')){
            Schema::create('sales_transaction_types', function (Blueprint $table) {
                $table->id();

                $table->string('sale_transaction_type_id');
				$table->string('name');
				$table->string('effect');

                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_transaction_types');
    }
};
