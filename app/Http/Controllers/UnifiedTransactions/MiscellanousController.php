<?php

namespace App\Http\Controllers\UnifiedTransactions;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UnifiedTransactions\UnifiedTransactions;

class MiscellanousController extends Controller
{
    private $modelReference;

    public function __construct()
    {
        $this->modelReference = 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $transaction = UnifiedTransactions::where('model', $this->modelReference)->get();
            $totalTransactions = UnifiedTransactions::where('model', $this->modelReference)
            ->groupBy('currency')
            ->select('currency', DB::raw('SUM(amount_paid) as total_amount'))
            ->get();
            return view('unified_transactions.miscellanous.index', compact('transaction','totalTransactions'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading page.');
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
            return view('unified_transactions.miscellanous.create', compact('currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading page.');
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
                'payment_type.required' => 'The payment type is required.'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $transaction = UnifiedTransactions::create([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'currency'          =>  $request->currency,
                    'rate'              =>  $request->rate,
                    'amount_paid'       =>  number_format($request->amount_paid, 2, '.', ''),
                    'payment_type'      =>  $request->payment_type,
                    'model'             =>  $this->modelReference
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
            $transaction = UnifiedTransactions::find($id);
            $currencies = Currency::all();

            if (!$transaction) {
                return back()->with('error', 'Record not found. Try again!');
            }
            return view('unified_transactions.miscellanous.edit', compact('transaction','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading page.');
        }
    }

    public function view($id)
    {
        try {
            $transaction = UnifiedTransactions::find($id);
            $currencies = Currency::all();

            if (!$transaction) {
                return response()->json([
                    'message' => 'Record not found.',
                    'success' => false
                ], 500);
            }
            return view('unified_transactions.miscellanous.view',  compact('transaction','currencies'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $transaction = UnifiedTransactions::find($id);

            if (!$transaction) {
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
                'payment_type.required' => 'The payment type is required.'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $transaction->update([
                    'transaction_date'  =>  $request->transaction_date,
                    'description'       =>  $request->description,
                    'notes'             =>  $request->notes,
                    'full_name'         =>  $request->full_name,
                    'phone'             =>  $request->phone,
                    'currency'          =>  $request->currency,
                    'rate'              =>  $request->rate,
                    'amount_paid'       =>  number_format($request->amount_paid, 2, '.', ''),
                    'payment_type'      =>  $request->payment_type
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Updated successfully",
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

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $transaction = UnifiedTransactions::find($id);

                if (!$transaction) {
                    return back()->with('error', 'Record not found. Try again!');
                }

                $transaction->delete();
            });

            return back()->with('success', 'Record deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
