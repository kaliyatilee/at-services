<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Currency;
use App\Models\InsurancePayment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    public function view(Request $request)
    {

        $currencies = Currency::all();

        $data['currencies'] = $currencies;
        return view('currency.list', $data);
    }

    public function add(Request $request, $id = null)
    {

        if ($id != null) {
            $currency = Currency::findOrFail($id);
            $data['currency'] = $currency;
        } else {
            $data['currency'] = new Currency();
        }

        return view('currency.add', $data);
    }

    public function getCurrency(Request $request, $currency = null)
    {

        if ($currency != null) {
            $data = Currency::query()->where("name", $currency)->first();
        } else {
            $data = Currency::all();
        }

        return response()->json([
            'data' => $data,
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function getExchangeRate(Request $request, $currency = null)
    {
        if ($currency == null) {
            return response()->json([
                'message' => "No currency found",
                'success' => false
            ], 500);
        }

        $data = Currency::query()->where("name", $currency)->first();

        if ($data == null) {
            if ($currency == null) {
                return response()->json([
                    'message' => "No currency found",
                    'success' => false
                ], 500);
            }
        }

        return response()->json([
            'data' => $data->exchange_rate,
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function create_currency(Request $request)
    {
        $data = $request->validate([
            "name" => ['required', 'string', 'min:1', Rule::unique("currency")],
            "exchange_rate" => "required|numeric|min:1"
        ]);

        $currency = new Currency();
        $currency->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_currency(Request $request, $id)
    {
        $data = $request->validate([
            "name" => ['required', 'string', 'min:1'],
            "exchange_rate" => "required|numeric|min:1"
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }
}
