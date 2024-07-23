<?php

namespace App\Http\Controllers\BulkAirtime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\BulkAirtime\StockRecord;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

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
            return view('bulk-airtime.stock-record.index', compact('stockRecord'));
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
                'in'                => 'nullable',
                'out'               => 'nullable|string|max:30',
                'shortages'         => 'required'
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date'     => 'The transaction date must be a valid date.',
                'description.required'      => 'The description is required.',
                'in.required_without'       => 'Either In or Out is required.',
                'out.required_without'      => 'Either In or Out is required.',
                'shotages.required'         => 'The shortages field is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $stockRecord = StockRecord::create([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'in'                =>  $request->in,
                    'out'               =>  $request->out,
                    'shortages'         =>  $request->shortages,
                    'balance'           =>  $request->balance,
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
                'in'                => 'nullable',
                'out'               => 'nullable|string|max:30',
                'shortages'         => 'required'
            ], [
                'transaction_date.required' => 'The transaction date is required.',
                'transaction_date.date'     => 'The transaction date must be a valid date.',
                'description.required'      => 'The description is required.',
                'in.required_without'       => 'Either In or Out is required.',
                'out.required_without'      => 'Either In or Out is required.',
                'shotages.required'         => 'The shortages field is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {

                $stockRecord->update([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'in'                =>  $request->in,
                    'out'               =>  $request->out,
                    'shortages'         =>  $request->shortages,
                    'balance'           =>  $request->in,
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

                $record->delete();
            });

            return back()->with('success', 'Record deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
