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
            if (!Schema::hasColumn('insurance_brooker', 'total_remittance')) {
                $table->float("total_remittance");
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
            if (Schema::hasColumn('insurance_brooker', 'total_remittance')) {
                $table->dropColumn('total_remittance');
            }
        });
    }
};
