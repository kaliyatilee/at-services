<?php

namespace App\Observers;

use App\Models\DrinkSale;
use App\Models\StockEntry;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StockObserver
{
    /**
     * Handle the DrinkSale "created" event.
     *
     * @param DrinkSale $drinkSale
     * @return void
     */
    public function created(DrinkSale $drinkSale)
    {
        try {
            DB::beginTransaction();
            $item = $drinkSale->item;
            if ($drinkSale->type->effect == 'adds'){
                $item->update([
                    'quantity' => $item->quantity - $drinkSale->quantity,
                ]);
            }

            if ($drinkSale->type->effect == 'subtracts'){
                $item->update([
                    'quantity' => $item->quantity + $drinkSale->quantity,
                ]);
            }

            StockEntry::create([
                'stock_entry_id' => Str::orderedUuid(),
                'item_id' => $item->item_id,
                'date' => $drinkSale->date,
                'description' => $drinkSale->description,
                'transaction_type' => $drinkSale->payment_type,
                'quantity' => $drinkSale->quantity,
                'amount' => $drinkSale->amount_paid
            ]);
            DB::commit();
        } catch (Exception $e){
            dd($e);
        }
    }

    /**
     * Handle the DrinkSale "updated" event.
     *
     * @param DrinkSale $drinkSale
     * @return void
     */
    public function updated(DrinkSale $drinkSale)
    {
        //
    }

    /**
     * Handle the DrinkSale "deleted" event.
     *
     * @param DrinkSale $drinkSale
     * @return void
     */
    public function deleted(DrinkSale $drinkSale)
    {
        //
    }

    /**
     * Handle the DrinkSale "restored" event.
     *
     * @param DrinkSale $drinkSale
     * @return void
     */
    public function restored(DrinkSale $drinkSale)
    {
        //
    }

    /**
     * Handle the DrinkSale "force deleted" event.
     *
     * @param DrinkSale $drinkSale
     * @return void
     */
    public function forceDeleted(DrinkSale $drinkSale)
    {
        //
    }
}
