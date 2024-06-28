<?php

namespace App\Providers;

use App\Models\SalesTransactionType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $transactionTypes = [
            'Amount Received',
            'Amount Given'
        ];

        foreach ($transactionTypes as $transactionType) {
            $exist = SalesTransactionType::where('name', $transactionType)->first();
            if ($exist) continue;
            SalesTransactionType::create([
                'sale_transaction_type_id' => Str::orderedUuid(),
                'name' => $transactionType,
            ]);
        }
    }
}
