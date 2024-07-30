<?php

namespace App\Http\Controllers\BulkAirtime;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BulkAirtime\SalesRecord;
use App\Models\BulkAirtime\BulkAirtimeBalance;

class SalesRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $salesRecord = SalesRecord::all();
            $currencies = Currency::all();
            return view('bulk-airtime.sales-record.index', compact('salesRecord','currencies'));
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
            $currencies = Currency::all();
            return view('bulk-airtime.sales-record.create', compact('currencies'));
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
                'currency'          => 'required',
                'rate'              => 'required',
                'amount_paid'       => 'required',
                'payment_type'      => 'required|string',
                'percentage'        => 'required',
                'quantity'          => 'required',
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date' => 'The transaction date must be a valid date.',
                'description.required' => 'The description is required.',
                'full_name.required' => 'The full name is required.',
                'quantity.required' => 'Quantity is required.',
                'full_name.max' => 'The full name must not be more than 30 characters.',
                'phone.required' => 'The phone number is required.',
                'currency.required' => 'The currency is required.',
                'rate.required' => 'The rate is required.',
                'rate.decimal' => 'The rate must be a decimal number with 2 places.',
                'amount_paid.required' => 'The amount paid is required.',
                'amount_paid.decimal' => 'The amount paid must be a decimal number with 2 places.',
                'payment_type.required' => 'The payment type is required.',
                'percentage.required' => 'The commission percentage is required.',
                'percentage.decimal' => 'The commission percentage must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {

                $commission = number_format($request->amount_paid, 2) * number_format($request->percentage, 2) / 100;

                $currentBalance = BulkAirtimeBalance::firstOrFail()->current_balance ?? 0;

                if($request->amount_paid > $currentBalance){
                    return response()->json([
                        'message' => "Sale cannot complete. Out-of-stock for required amount.",
                        'success' => false
                    ]);
                }

                $newBalance = $currentBalance - $request->amount_paid;

                $salesRecord = SalesRecord::create([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'quantity'          =>  $request->quantity,
                    'currency'          =>  $request->currency,
                    'rate'              =>  number_format($request->rate,2),
                    'amount_paid'       =>  number_format($request->amount_paid,2),
                    'payment_type'      =>  $request->payment_type,
                    'percentage'        =>  number_format($request->percentage,2),
                    'commission_usd'    => number_format($commission,2)
                ]);

                BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                    'current_balance' => number_format($newBalance, 2)
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Saved successfully",
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => $e->getMessage() - 'Something went wrong. Please try again later.',
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
            $salesRecord = SalesRecord::find($id);
            $currencies = Currency::all();

            if (!$salesRecord) {
                return back()->with('error', 'Record not found. Try again!');
            }

            return view('bulk-airtime.sales-record.edit', compact('salesRecord','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function view($id)
    {
        try {
            $salesRecord = SalesRecord::find($id);
            $currencies = Currency::all();

            if (!$salesRecord) {
                return back()->with('error', 'Record not found. Try again!');
            }

            return view('bulk-airtime.sales-record.view', compact('salesRecord','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $salesRecord = SalesRecord::find($id);

            if (!$salesRecord) {
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
                'phone'             => 'required',
                'currency'          => 'required',
                'rate'              => 'required',
                'amount_paid'       => 'required',
                'payment_type'      => 'required|string',
                'percentage'        => 'required',
                'quantity'          => 'required',
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date' => 'The transaction date must be a valid date.',
                'description.required' => 'The description is required.',
                'full_name.required' => 'The full name is required.',
                'quantity.required' => 'Quantity is required.',
                'full_name.max' => 'The full name must not be more than 30 characters.',
                'phone.required' => 'The phone number is required.',
                'currency.required' => 'The currency is required.',
                'rate.required' => 'The rate is required.',
                'rate.decimal' => 'The rate must be a decimal number with 2 places.',
                'amount_paid.required' => 'The amount paid is required.',
                'amount_paid.decimal' => 'The amount paid must be a decimal number with 2 places.',
                'payment_type.required' => 'The payment type is required.',
                'percentage.required' => 'The commission percentage is required.',
                'percentage.decimal' => 'The commission percentage must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $commission = number_format($request->amount_paid,2) * number_format($request->percentage,2) / 100;

                $currentBalance = BulkAirtimeBalance::firstOrFail()->current_balance ?? 0;

                if($request->amount_paid > $currentBalance){
                    return response()->json([
                        'message' => "Sale cannot complete. Out-of-stock for required amount.",
                        'success' => false
                    ]);
                }

                $newBalance = $currentBalance - $request->amount_paid;

                $salesRecord->update([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'quantity'          =>  $request->quantity,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'currency'          =>  $request->currency,
                    'rate'              =>  number_format($request->rate,2),
                    'amount_paid'       =>  number_format($request->amount_paid,2),
                    'payment_type'      =>  $request->payment_type,
                    'percentage'        =>  number_format($request->percentage,2),
                    'commission_usd'    => number_format($commission,2)
                ]);

                BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                    'current_balance' => number_format($newBalance, 2)
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Updated successfully",
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
                $record = SalesRecord::find($id);

                // Check if the resource exists
                if (!$record) {
                    return back()->with('error', 'Record not found. Try again!');
                }

                $currentBalance = BulkAirtimeBalance::firstOrFail()->current_balance ?? 0;

                $newBalance = $currentBalance + $record->amount_paid;

                BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                    'current_balance' => number_format($newBalance, 2)
                ]);


                $record->delete();
            });

            return back()->with('success', 'Record deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
