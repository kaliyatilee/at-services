<?php

namespace App\Http\Controllers\DryCleaning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DryCleaning\SalesBook;
use App\Models\Currency;
use App\Models\DryCleaning\ServiceProviders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;


class SalesBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $salesBooks = SalesBook::all();
            $currencies = Currency::all();
            return view('dry-cleaning.sales-book.index', compact('salesBooks','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while retrieving sales books.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $serviceProviders = ServiceProviders::all();
            $currencies = Currency::all();
            return view('dry-cleaning.sales-book.create', compact('serviceProviders','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the create sales book page.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'transaction_date'  => 'required|date',
                'description'       => 'required|string',
                'notes'             => 'nullable',
                'full_name'         => 'required|string|max:30',
                'phone'             => 'required',
                'provider'          => 'required',
                'currency'          => 'required',
                'rate'              => 'required',
                'amount_paid'       => 'required',
                'payment_type'      => 'required|string',
                'expense_name'      => 'required|string',
                'expense_amount'    => 'required',
                'commission_percentage'  => 'required',
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date' => 'The transaction date must be a valid date.',
                'description.required' => 'The description is required.',
                'provider.required' => 'The provider is required.',
                'full_name.required' => 'The full name is required.',
                'full_name.max' => 'The full name must not be more than 30 characters.',
                'phone.required' => 'The phone number is required.',
                'currency.required' => 'The currency is required.',
                'rate.required' => 'The rate is required.',
                'rate.decimal' => 'The rate must be a decimal number with 2 places.',
                'amount_paid.required' => 'The amount paid is required.',
                'amount_paid.decimal' => 'The amount paid must be a decimal number with 2 places.',
                'payment_type.required' => 'The payment type is required.',
                'expense_name.required' => 'The expense name is required.',
                'expense_amount.required' => 'The expense amount is required.',
                'expense_amount.decimal' => 'The expense amount must be a decimal number with 2 places.',
                'commission_percentage.required' => 'The commission percentage is required.',
                'commission_percentage.decimal' => 'The commission percentage must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $cur_name = Currency::find($request->currency)->name;

                if ($cur_name == 'USD') {
                    $amountPaidUsd = $request->amount_paid;
                    $expenseAmountUsd = $request->expense_amount;
                } else {
                    $conversionRate = Currency::find($request->currency)->exchange_rate;
                    $amountPaidUsd = $request->amount_paid / $conversionRate;
                    $expenseAmountUsd = $request->expense_amount / $conversionRate;
                }

                $commissionAmount = $amountPaidUsd * ($request->commission_percentage / 100);
                
                $commissionUsd =$commissionAmount - $expenseAmountUsd;
                $remittanceUsd = $amountPaidUsd - $commissionAmount;

                

                $salesBook = SalesBook::create([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'provider'          =>  $request->provider,
                    'currency'          =>  $request->currency,
                    'rate'              =>  $request->rate,
                    'amount_paid'       =>  number_format($request->amount_paid, 2, '.', ''),
                    'payment_type'      =>  $request->payment_type,
                    'expense_name'      =>  $request->expense_name,
                    'expense_amount'    =>  number_format($request->expense_amount, 2, '.', ''),
                    'commission_percentage'  => number_format($request->commission_percentage, 2, '.', ''),
                    'remittance_usd'    => number_format($remittanceUsd, 2, '.', ''),
                    'commission_usd'    => number_format($commissionUsd, 2, '.', ''),
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Saved successfully",
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Something went wrong. Please try again later.',
                    'success' => false
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
                'success' => false
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $salesBook = SalesBook::find($id);
            $serviceProviders = ServiceProviders::all();
            $currencies = Currency::all();

            if (!$salesBook) {
                return back()->with('error', 'Record not found. Try again!');
            }

            return view('dry-cleaning.sales-book.edit', compact('salesBook','serviceProviders','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $salesBook = SalesBook::find($id);

            if (!$salesBook) {
                return response()->json([
                    'message' => 'Record not found.',
                    'success' => false
                ], 500);
            }

            $validator = validator()->make($request->all(), [
                'transaction_date'  => 'required|date',
                'description'       => 'required|string',
                'notes'             => 'nullable',
                'full_name'         => 'required|string|max:30',
                'provider'          => 'required',
                'phone'             => 'required',
                'currency'          => 'required',
                'rate'              => 'required',
                'amount_paid'       => 'required',
                'payment_type'      => 'required|string',
                'expense_name'      => 'required|string',
                'expense_amount'    => 'required',
                'commission_percentage'  => 'required',
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date' => 'The transaction date must be a valid date.',
                'description.required' => 'The description is required.',
                'full_name.required' => 'The full name is required.',
                'full_name.max' => 'The full name must not be more than 30 characters.',
                'phone.required' => 'The phone number is required.',
                'currency.required' => 'The currency is required.',
                'rate.required' => 'The rate is required.',
                'rate.decimal' => 'The rate must be a decimal number with 2 places.',
                'amount_paid.required' => 'The amount paid is required.',
                'amount_paid.decimal' => 'The amount paid must be a decimal number with 2 places.',
                'payment_type.required' => 'The payment type is required.',
                'expense_name.required' => 'The expense name is required.',
                'expense_amount.required' => 'The expense amount is required.',
                'expense_amount.decimal' => 'The expense amount must be a decimal number with 2 places.',
                'commission_percentage.required' => 'The commission percentage is required.',
                'commission_percentage.decimal' => 'The commission percentage must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $cur_name = Currency::find($request->currency)->name;

                if ($cur_name == 'USD') {
                    $amountPaidUsd = $request->amount_paid;
                    $expenseAmountUsd = $request->expense_amount;
                } else {
                    $conversionRate = Currency::find($request->currency)->exchange_rate;
                    $amountPaidUsd = $request->amount_paid / $conversionRate;
                    $expenseAmountUsd = $request->expense_amount / $conversionRate;
                }

                $commissionAmount = $amountPaidUsd * ($request->commission_percentage / 100);
                
                $commissionUsd =$commissionAmount - $expenseAmountUsd;
                $remittanceUsd = $amountPaidUsd - $commissionAmount;

                $salesBook->update([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'provider'          =>  $request->provider,
                    'currency'          =>  $request->currency,
                    'rate'              =>  $request->rate,
                    'amount_paid'       =>  number_format($request->amount_paid, 2, '.', ''),
                    'payment_type'      =>  $request->payment_type,
                    'expense_name'      =>  $request->expense_name,
                    'expense_amount'    =>  number_format($request->expense_amount, 2, '.', ''),
                    'commission_percentage'  => number_format($request->commission_percentage, 2, '.', ''),
                    'remittance_usd'    => number_format($remittanceUsd, 2, '.', ''),
                    'commission_usd'    => number_format($commissionUsd, 2, '.', ''),
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Saved successfully",
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return response()->json([
                    'message' => 'Something went wrong. Please try again later.',
                    'success' => false
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
                'success' => false
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $record = SalesBook::find($id);

                // Check if the resource exists
                if (!$record) {
                    return back()->with('error', 'Record not found. Try again!');
                }

                $record->delete();
            });

            return back()->with('success', 'Record deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
