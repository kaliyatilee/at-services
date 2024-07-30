<?php

namespace App\Http\Controllers\BulkAirtime;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BulkAirtime\StockRecord;
use App\Models\BulkAirtime\BulkAirtimeBalance;

class StockRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {
            $stockRecord = StockRecord::all();
            $StockBalance = BulkAirtimeBalance::firstOrFail()->current_balance;

            return view('bulk-airtime.stock-record.index', compact('stockRecord','StockBalance'));
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
            return view('bulk-airtime.stock-record.create', compact('currencies'));
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
                'in'                => 'required_without:out',
                'out'               => 'required_without:in',
                'shortages'         => 'nullable'
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date'     => 'The transaction date must be a valid date.',
                'description.required'      => 'The description is required.',
                'in.required_without'       => 'Either In or Out is required.',
                'out.required_without'      => 'Either In or Out is required.',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $balance = $request->in ?: $request->out - $request->shortages;

                $currentBalance = BulkAirtimeBalance::firstOrFail()->current_balance ?? 0;

                if($request->in){
                    $newBalance = $request->in + $currentBalance;

                    BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                        'current_balance' => number_format($newBalance, 2)
                    ]);
                }else{
                   if($request->out > $currentBalance){
                        return response()->json([
                            'message' => "Stock out can not be greater than available stock.",
                            'success' => false
                        ]);
                   }
                }

                $stockRecord = StockRecord::create([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'in'                =>  number_format($request->in, 2),
                    'out'               =>  number_format($request->out, 2),
                    'shortages'         =>  number_format($request->shortages, 2),
                    'balance'           =>  number_format($balance, 2),
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Saved successfully",
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Something went wrong. Please try again later.' .$e,
                    'success' => false
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong. Please try again later.'.$e,
                'success' => false
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $stockRecord = StockRecord::find($id);

            if (!$stockRecord) {
                return back()->with('error', 'Record not found. Try again!');
            }

            return view('bulk-airtime.stock-record.edit', compact('stockRecord'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function view($id)
    {
        try {
            $stockRecord = StockRecord::find($id);
            $currencies = Currency::all();

            if (!$stockRecord) {
                return back()->with('error', 'Record not found. Try again!');
            }

            return view('bulk-airtime.stock-record.view', compact('stockRecord','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $stockRecord = StockRecord::find($id);

            if (!$stockRecord) {
                return response()->json([
                    'message' => 'Record not found.',
                    'success' => false
                ], 500);
            }

            $validator = validator()->make($request->all(), [
                'transaction_date'  => 'required|date',
                'description'       => 'required|string',
                'in'                => 'required_without:out',
                'out'               => 'required_without:in',
                'shortages'         => 'nullable'
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date'     => 'The transaction date must be a valid date.',
                'description.required'      => 'The description is required.',
                'in.required_without'       => 'Either In or Out is required.',
                'out.required_without'      => 'Either In or Out is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $balance = $request->in ?: $request->out - $request->shortages;

                $currentBalance = BulkAirtimeBalance::firstOrFail()->current_balance ?? 0;

                if($request->in){
                    $newBalance = $request->in + $currentBalance;

                    BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                        'current_balance' => number_format($newBalance, 2)
                    ]);
                }else{
                   if($request->out > $currentBalance){
                        return response()->json([
                            'message' => "Stock out can not be greater than available stock.",
                            'success' => false
                        ]);
                   }
                }

                $stockRecord->update([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'in'                =>  number_format($request->in, 2),
                    'out'               =>  number_format($request->out, 2),
                    'shortages'         =>  number_format($request->shortages, 2),
                    'balance'           =>  number_format($balance, 2),
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
                $record = StockRecord::find($id);

                // Check if the resource exists
                if (!$record) {
                    return back()->with('error', 'Record not found. Try again!');
                }
                $currentBalance = BulkAirtimeBalance::firstOrFail()->current_balance ?? 0;

                if($record->in){
                    $newBalance = $currentBalance - $record->in;

                    BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                        'current_balance' => number_format($newBalance, 2)
                    ]);
                }else{
                    $newBalance = $currentBalance + $record->out;

                    BulkAirtimeBalance::updateOrCreate(['id' => 1], [
                        'current_balance' => number_format($newBalance, 2)
                    ]);
                }

                $record->delete();
            });

            return back()->with('success', 'Record deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
