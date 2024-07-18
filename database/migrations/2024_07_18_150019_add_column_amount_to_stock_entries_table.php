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
        if(Schema::hasTable('stock_entries') && !Schema::hasColumns('stock_entries', ['amount'])){
            Schema::table('stock_entries', function (Blueprint $table) {
                $table->string('amount')->default(0)->after('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('stock_entries') && Schema::hasColumns('stock_entries', ['amount'])){
            Schema::table('stock_entries', function (Blueprint $table) {
                $table->dropColumn(['amount']);
            });
        }
    }
};
