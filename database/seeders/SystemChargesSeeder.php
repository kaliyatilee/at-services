<?php

namespace Database\Seeders;

use App\Models\SystemCharge;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemChargesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemCharge::create([
            'name' => 'USD',
        ]);
        SystemCharge::create([
            'name' => 'ZAR',
        ]);
    }
}