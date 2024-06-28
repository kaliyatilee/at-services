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
        if(Schema::hasTable('general_sales') && !Schema::hasColumns('general_sales', ['transaction_date'])){
            Schema::table('general_sales', function (Blueprint $table) {
                $table->string('transaction_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('general_sales') && Schema::hasColumns('general_sales', ['transaction_date'])){
            Schema::table('general_sales', function (Blueprint $table) {
                $table->dropColumn(['transaction_date']);
            });
        }
    }
};
