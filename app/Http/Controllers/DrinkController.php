<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\StockEntry;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DrinkController extends Controller
{

    public function view()
    {
        $drinks = Drink::withTrashed()->get();
        return view('drinks.view', compact('drinks'));
    }

    public function create()
    {
        return view('drinks.create');
    }

    public function edit($drink)
    {
        $drink = Drink::whereDrinkId($drink)->withTrashed()->firstOrFail();
        return view('drinks.edit', compact('drink'));
    }

    public function store(Request $request)
    {
        try {
            $check = Drink::whereName($request->name)->first();
            if ($check) {
                return redirect()->back()->with('error', 'Drink already exists');
            }

            Drink::create([
                'drink_id' => Str::orderedUuid(),
                'name' => $request->name,
            ]);

            return to_route('drinks')->with('success', "Drink saved successfully");
        } catch (Exception){
            return redirect()->back()->with('error', 'Failed. Please try again');
        }
    }

    public function update(Request $request)
    {
        try {
            $drink = Drink::whereDrinkId($request->drink_id)->withTrashed()->firstOrFail();
            if (!$drink) {
                return redirect()->back()->with('error', "Drink doesn't exists");
            }

            $drink->update([
                'name' => $request->name
            ]);

            return to_route('drinks')->with('success', "Drink updated successfully");
        } catch (Exception){
            return redirect()->back()->with('error', 'Failed. Please try again');
        }
    }

    public function viewTransactions($drinkId)
    {
        $stockEntries = StockEntry::whereItemId($drinkId)->get();
        $drink = Drink::whereDrinkId($drinkId)->withTrashed()->firstOrFail();
        return view('drinks.transactions', compact('stockEntries', 'drink'));
    }

    public function delete(Request $request, $drinkId = null)
    {
        $drinkId = $request->drink_id;
        $drink = Drink::whereDrinkId($drinkId)->withTrashed()->firstOrFail();
        if ($request->method() == 'GET'){
            return view('drinks.delete', compact('drink'));
        }
        if ($request->method() == 'POST'){
            try {
                if ($drink->trashed()) {
                    $drink->restore();
                }else{
                    $drink->delete();
                }
                return to_route('drinks');
            } catch (Exception){
                return redirect()->back()->with('error', 'Failed to delete. Please try again');
            }
        }
    }
}
