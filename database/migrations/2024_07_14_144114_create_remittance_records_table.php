<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('remittance_records', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_remittance');
            $table->string('method_of_remittance');
            $table->decimal('amount_remitted_zig', 10, 2);
            $table->decimal('amount_remitted_usd', 10, 2);
            $table->decimal('account_balance_zig', 10, 2);
            $table->decimal('account_balance_usd', 10, 2);
            $table->timestamps();
        });
    
        DB::unprepared('
            CREATE TRIGGER update_balance_zig
            BEFORE INSERT ON remittance_records
            FOR EACH ROW
            BEGIN
                SET NEW.account_balance_zig = (
                    (SELECT COALESCE(SUM(expected_amount_zig), 0) FROM vehicle_licence_transactions) - NEW.amount_remitted_zig
                );
            END
        ');
    
        DB::unprepared('
            CREATE TRIGGER update_balance_usd
            BEFORE INSERT ON remittance_records
            FOR EACH ROW
            BEGIN
                SET NEW.account_balance_usd = (
                    (SELECT COALESCE(SUM(expected_amount_usd), 0) FROM vehicle_licence_transactions) - NEW.amount_remitted_usd
                );
            END
        ');
    }    

    public function down()
    {
        Schema::dropIfExists('remittance_records');
    }
};
