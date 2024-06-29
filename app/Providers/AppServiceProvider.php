<?php

namespace App\Providers;

use App\Models\SalesTransactionType;
use Exception;
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
        try {
            $transactionTypes = [
                [
                    'name' =>'Amount Received',
                    'effect' => 'adds'
                ],
                [
                    'name' => 'Amount Given',
                    'effect' => 'subtracts'
                ]
            ];

            foreach ($transactionTypes as $transactionType) {
                $name = $transactionType['name'];
                $effect = $transactionType['effect'];
                $exist = SalesTransactionType::where('name', $name)->first();
                if ($exist) continue;
                SalesTransactionType::create([
                    'sale_transaction_type_id' => Str::orderedUuid(),
                    'name' => $name,
                    'effect' => $effect
                ]);
            }
        } catch (Exception) {

        }
    }
}
