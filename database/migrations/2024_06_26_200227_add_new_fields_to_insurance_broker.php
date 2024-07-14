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
        Schema::table('insurance_brooker', function (Blueprint $table) {
            if (!Schema::hasColumn('insurance_brooker', 'date_of_remittance')) {
                $table->date("date_of_remittance")->nullable();
            }
            if (!Schema::hasColumn('insurance_brooker', 'method_of_remittance')) {
                $table->string("method_of_remittance");
            }
            if (!Schema::hasColumn('insurance_brooker', 'amount_remitted')) {
                $table->float("amount_remitted");
            }
            if (!Schema::hasColumn('insurance_brooker', 'account_balance')) {
                $table->float("account_balance");
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_brooker', function (Blueprint $table) {
            if (Schema::hasColumn('insurance_brooker', 'date_of_remittance')) {
                $table->dropColumn('date_of_remittance');
            }
            if (Schema::hasColumn('insurance_brooker', 'method_of_remittance')) {
                $table->dropColumn('method_of_remittance');
            }
            if (Schema::hasColumn('insurance_brooker', 'amount_remitted')) {
                $table->dropColumn('amount_remitted');
            }
            if (Schema::hasColumn('insurance_brooker', 'account_balance')) {
                $table->dropColumn('account_balance');
            }
        });
    }
};

