<?php

namespace App\Http\Controllers\Printing;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Exports\PrintingExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PrintingServices\PrintingSales;

class PrintingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

           $printSales = PrintingSales::all();
            return view('printing.index', compact('printSales'));
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
            return view('printing.create', compact('currencies'));
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
                'full_name'         => 'required',
                'phone'             => 'required',
                'rate'              => 'required',
                'amount_paid'       => 'required',
                'payment_type'      => 'required|string',
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
                'commission_percentage.required' => 'The commission percantage is required.',
                'commission_percentage.decimal' => 'The commission percentage must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {

                $commissionAmount = number_format($request->amount_paid , 2);
                $cur = Currency::where('name', 'USD')->first()->id;
                
                $sales= PrintingSales::create([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'currency'          =>  $cur,
                    'rate'              =>  number_format($request->rate, 2),
                    'amount_paid'       =>  number_format($request->amount_paid, 2),
                    'payment_type'      =>  $request->payment_type,
                    'commission' => number_format($request->amount_paid, 2),
                    'commission_usd'    =>  number_format($commissionAmount, 2)
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

    public function export($id)
    {
        $printingSales = PrintingSales::find($id);
        return Excel::download(new PrintingExport($printingSales), 'printing_'.$printingSales->full_name.'_.xlsx');
    }

    public function edit($id)
    {
        try {
            $salesBook = PrintingSales::find($id);
            $currencies = Currency::all();

            if (!$salesBook) {
                return response()->json([
                    'message' => 'Record not found.',
                    'success' => false
                ], 500);
            }

            return view('printing.edit', compact('salesBook','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function view($id)
    {
        try {
            $salesBook = PrintingSales::find($id);
            $currencies = Currency::all();

            if (!$salesBook) {
                return response()->json([
                    'message' => 'Record not found.',
                    'success' => false
                ], 500);
            }

            return view('printing.view', compact('salesBook','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit sales book page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $sales = PrintingSales::find($id);

            if (!$sales) {
                return response()->json([
                    'message' => 'Record not found.',
                    'success' => false
                ], 500);
            }

            $validator = validator()->make($request->all(), [
                'transaction_date'  => 'required|date',
                'description'       => 'required|string',
                'notes'             => 'nullable',
                'full_name'         => 'required',
                'phone'             => 'required',
                'rate'              => 'required',
                'amount_paid'       => 'required',
                'payment_type'      => 'required|string',
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
                'commission_percentage.required' => 'The commission percantage is required.',
                'commission_percentage.decimal' => 'The commission percentage must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $commissionAmount = number_format($request->amount_paid , 2);
                $cur = Currency::where('name', 'USD')->first()->id;

                $sales->update([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'currency'          =>  $cur,
                    'rate'              =>  number_format($request->rate, 2),
                    'amount_paid'       =>  number_format($request->amount_paid, 2),
                    'payment_type'      =>  $request->payment_type,
                    'commission' => number_format($request->amount_paid, 2),
                    'commission_usd'    =>  number_format($commissionAmount, 2)
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
                $record = PrintingSales::find($id);

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