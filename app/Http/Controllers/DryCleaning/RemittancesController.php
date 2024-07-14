<?php

namespace App\Http\Controllers\DryCleaning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DryCleaning\RemittancesBook;
use App\Models\DryCleaning\ServiceProviders;
use App\Models\DryCleaning\SalesBook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RemittancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $serviceProviders = ServiceProviders::all();
            return view('dry-cleaning.remittances.index', compact('serviceProviders'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while retrieving service providers.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            $remittanceHistory = RemittancesBook::where('provider_remitted_to', $id)->get();

            $totalAmountRemitted = RemittancesBook::where('provider_remitted_to', $id)->sum('amount_remitted');
            $totalProviderSales = SalesBook::where('provider', $id)->sum('remittance_usd');

            $remittanceBalance = number_format($totalProviderSales - $totalAmountRemitted, 2);

            return view('dry-cleaning.remittances.create', compact('id', 'remittanceHistory','remittanceBalance'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the create remittances book page.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $validator = validator()->make($request->all(), [
                'remittance_date'   => 'required|date|date_equals:today',
                'remittance_method' => 'required|string',
                'amount_remitted'   => 'required|',
            ], [
                'remittance_date.required'  => 'The remittance date is required.',
                'remittance_date.date'      => 'The remittance date must be a valid date.',
                'remittance_date.date_equals' => 'The date must be today\'s date.',
                'provider_remitted_to.required'      => 'The recipient is required.',
                'remittence_method.required' => 'The remittance method is required.',
                'amount_remitted.required' => 'The amount remitted is required.',
                'amount_remitted.decimal' => 'The amount remitted must be a decimal number with 2 places.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {
                $totalAmountRemitted = RemittancesBook::where('provider_remitted_to', $id)->sum('amount_remitted');
                $totalProviderSales = SalesBook::where('provider', $id)->sum('remittance_usd');

                $remittanceBalance = number_format($totalProviderSales - $totalAmountRemitted, 2);

                $newRemittanceBalance = number_format($remittanceBalance - $request->amount_remitted, 2);

               
                if($request->amount_remitted > $remittanceBalance){
                    return response()->json([
                        'message' => 'Amount can not exceed current balance',
                        'success' => false
                    ], 500);
                }

                $remittancesBook = RemittancesBook::create([
                    'remittance_date'   =>  $request->remittance_date,
                    'provider_remitted_to'       =>  $id,
                    'remittance_method' =>  $request->remittance_method,
                    'amount_remitted'   =>  number_format($request->amount_remitted, 2),
                    'account_balance'   =>  number_format($newRemittanceBalance, 2),
                ]);

                DB::commit();
                return response()->json([
                    'message' => "Saved successfully",
                    'success' => true
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => $e->getMessage(),
                    'success' => false
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $record = RemittancesBook::find($id);

                // Check if the resource exists
                if (!$record) {
                   return redirect()->back();
                }

                $record->delete();
            });

            return back()->with('success', 'Record deleted.');

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
    
}
 