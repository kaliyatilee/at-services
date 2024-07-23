<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BulkAirtime\BulkAirtimeBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BulkAirtimeBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BulkAirtimeBalance::create([
            'current_balance' => 0.00,
        ]);
    }
}
