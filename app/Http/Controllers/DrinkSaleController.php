<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Drink;
use App\Models\DrinkSale;
use App\Models\GeneralSales\GeneralSaleTransactionType;
use App\Models\SalesTransactionType;
use App\Models\StockEntry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DrinkSaleController extends Controller
{
    public function edit($drink_sale_id)
    {
        $drinkSale = DrinkSale::whereDrinkSaleId($drink_sale_id)->firstOrFail();
        $drinks = Drink::all();
        $currencies = Currency::all();
        $paymentTypes = SalesTransactionType::all();
        return view('drink-sales.edit', compact('drinkSale', 'drinks', 'currencies', 'paymentTypes'));
    }

    public function view($drink_id)
    {
        $drinkSale = DrinkSale::whereDrinkId($drink_id)->firstOrFail();
        return view('drink-sales.view', compact('drinkSale'));
    }

    public function list()
    {
        $drinkSales = DrinkSale::all();
        return view('drink-sales.list', compact('drinkSales'));
    }

    public function entries()
    {
        $stockEntries = StockEntry::all();
        return view('drink-sales.entries', compact('stockEntries'));
    }

    public function create()
    {
        $drinks = Drink::all();
        $currencies = Currency::all();
        $paymentTypes = SalesTransactionType::all();
        return view('drink-sales.create', compact('drinks', 'currencies', 'paymentTypes'));
    }

    public function store(Request $request)
    {
        try {
            $currency = Currency::whereId($request->currency_id)->firstOrFail();
            DrinkSale::create([
                'drink_sale_id' => Str::orderedUuid(),
                'drink_id' => $request->drink_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'currency_id' => $currency->id,
                'rate' => $currency->rate,
                'amount_paid' => $request->amount_paid,
                'payment_type' => $request->payment_type,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'description' => $request->description,
                'notes' => $request->notes,
                'expense_name' => $request->expense_name,
                'expense_amount' => $request->expense_amount,
                'commission_amount' => $request->amount_paid - $request->expense_amount
            ]);

            return to_route('drink-sales')->with('success', "Drink saved successfully");
        } catch (Exception $e){
            return redirect()->back()->with('error', 'Failed. Please try again');
        }
    }

    public function delete(Request $request, $drinkId = null)
    {
        $drinkId = $request->drink_id;
        $drinkSale = DrinkSale::whereDrinkId($drinkId)->firstOrFail();
        if ($request->method() == 'GET'){
            return view('drink-sales.delete', compact('drinkSale'));
        }
        if ($request->method() == 'POST'){
            try {
                $drinkSale->delete();
                return to_route('drink-sales');
            } catch (Exception $e){
                return redirect()->back()->with('error', 'Failed to delete. Please try again');
            }
        }
    }

    public function update(Request $request)
    {
        try {
            $sale = DrinkSale::whereDrinkSaleId($request->sale_id)->firstOrFail();
            if (!$sale) {
                return redirect()->back()->with('error', "Sale doesn't exists");
            }

            $currency = Currency::whereId($request->currency_id)->firstOrFail();

            $sale->update([
                'drink_id' => $request->drink_id,
                'description' => $request->description,
                'notes' => $request->notes,
                'name' => $request->name,
                'phone' => $request->phone,
                'currency_id' => $currency->id,
                'rate' => $currency->rate,
                'amount_paid' => $request->amount_paid,
                'payment_type' => $request->payment_type,
                'quantity' => $request->quantity,
                'expense_name' => $request->expense_name,
                'expense_amount' => $request->expense_amount,
                'commission_amount' => $request->amount_paid - $request->expense_amount
            ]);

            return to_route('drink-sales')->with('success', "Drink Sale updated successfully");
        } catch (Exception $e){
            return redirect()->back()->with('error', 'Failed. Please try again');
        }
    }
}
