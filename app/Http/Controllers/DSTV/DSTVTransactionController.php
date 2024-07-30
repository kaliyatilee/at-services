<?php

namespace App\Http\Controllers\DSTV;

use App\Models\Client;
use function response;
use App\Models\Currency;
use App\Models\DSTVPackage;
use App\Models\SystemCharge;
use Illuminate\Http\Request;
use App\Models\DSTVTransaction;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Messaging\Http\Controllers\DigitalReceiptsMessagingController;

class DSTVTransactionController extends Controller
{


    public function view(Request $request){
        $dstv_transactions = DSTVTransaction::all();
        $data['dstv_transactions'] = $dstv_transactions;
        return view('dstv.transaction.list',$data);
    }
    public function add(Request $request,$id = null){

        if($id != null) {
            $dstv_transaction = DSTVTransaction::findOrFail($id);
            $data['dstv_transaction'] = $dstv_transaction;
        }else{
            $data['dstv_transaction'] = new DSTVTransaction();
        }

        $data['dstv_packages'] = DSTVPackage::all();
        $data['currencies'] = Currency::all();
        $data['system_charges'] = SystemCharge::all();

        return view('dstv.transaction.add',$data);
    }

	public function dstv_transaction_edit($id){

        $dstv_transaction = DSTVTransaction::findOrFail($id);
        $data['dstv_transaction'] = $dstv_transaction;
        $data['dstv_packages'] = DSTVPackage::all();
        $data['currencies'] = Currency::all();
        $data['system_charges'] = SystemCharge::all();
        return view('dstv.transaction.edit',$data);

	}

	public function dstv_transaction_view($id){

        $dstv_transaction = DSTVTransaction::findOrFail($id);
        $data['dstv_transaction'] = $dstv_transaction;
        $data['currencies'] = Currency::all();
        $data['dstv_packages'] = DSTVPackage::all();
        $data['system_charges'] = SystemCharge::all();

        return view('dstv.transaction.view',$data);

	}

    public function create_dstv_transaction(Request $request)
    {

        $validator = validator()->make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'dstv_account_number' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
            'system_charges' => 'required|integer',
            'system_charge_amount' => 'required|integer',
            'package' => 'required|integer',
            'currency' => 'required|integer',
            'amount_paid' => 'required|numeric|between:0,999999.99',
            'rate' => 'required|numeric|between:0,999999.99',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string|max:255'
        ]);


        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        //$data['created_by'] = Auth::user()->id;
        $data['created_by'] = 1;
		$dstv_packages = DSTVPackage::findOrfail($data['package']);

        if (!$dstv_packages) {
            return response()->json([
                'message' => "Package not found.",
                'success' => false
            ]);
        }

        $expectedAmount = $request->currency === 'USD'
        ? $dstv_packages->amount_rand / Currency::find(2)->exchange_rate
        : $dstv_packages->amount_rand;

        if ($request->amount_paid < $expectedAmount) {
            return response()->json([
                'message' => "Amount Paid should not be less than package cost.",
                'success' => false
            ]);
        }

        $currency = Currency::findOrFail($request->currency);
        if (!$currency) {
            return response()->json([
                'message' => "Currency not found.",
                'success' => false
            ]);
        }

        $data['amount_paid_usd'] = $request->amount_paid / $currency->exchange_rate;

        try {
            $systemCharge = SystemCharge::find($request->system_charges);
            $currency = Currency::find($request->currency);

            if (!$systemCharge || !$currency) {
                return response()->json([
                    'message' => 'System charge or currency not found',
                    'success' => false
                ]);
            }

            $CurrencyId = 2; // Define a named constant or variable
            if ($systemCharge->name === 'ZAR' && $currency->name === 'USD') {
                $exchangeRate = Currency::find($CurrencyId)->exchange_rate;
                if ($exchangeRate === 0) {
                    throw new \Exception('Exchange rate cannot be zero');
                }

                $data['commission_usd'] = round(($request->amount_paid * $exchangeRate) - $request->system_charge_amount / $exchangeRate, 2);
            } elseif ($systemCharge->name === 'USD' && $currency->name === 'USD') {
                $data['commission_usd'] = round($request->amount_paid - $request->system_charge_amount, 2);
            } else {
                return response()->json([
                    'message' => "The given data is incorrect. Please check System Charge and Your Payment Currency.",
                    'success' => false
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 500);
        }

        $dstvTransaction = new DSTVTransaction();
        $dstvTransaction->create($data);

       $message = sprintf(
            'Transaction for DSTV Account %s with Package %s %s%s was successful.',
            $request->dstv_account_number,
            $dstv_packages->name,
            $currency->name,
            $request->amount_paid,
        );
        // digital receipt msg
        $digitalReceiptController = new DigitalReceiptsMessagingController();
        $sms = $digitalReceiptController->sendDigitalReceipt($data['phone'], $data['amount_paid'], $message);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true,
            'sms' => $sms
        ]);
    }

    public function update_dstv_transaction(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'dstv_account_number' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
            'system_charges' => 'required|integer',
            'system_charge_amount' => 'required|integer',
            'package' => 'required|integer',
            'currency' => 'required|integer',
            'amount_paid' => 'required|numeric|between:0,999999.99',
            'rate' => 'required|numeric|between:0,999999.99',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string|max:255'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $dstv_packages = DSTVPackage::findOrfail($data['package']);

        $dstvTransaction = DSTVTransaction::findOrFail($id);
        $dstv_packages = DSTVPackage::findOrfail($data['package']);

        if (!$dstv_packages) {
            return response()->json([
                'message' => "Package not found.",
                'success' => false
            ]);
        }

        $expectedAmount = $request->currency === 'USD'
        ? $dstv_packages->amount_rand / Currency::find(2)->exchange_rate
        : $dstv_packages->amount_rand;

        if ($request->amount_paid < $expectedAmount) {
            return response()->json([
                'message' => "Amount Paid should not be less than package cost.",
                'success' => false
            ]);
        }

        $currency = Currency::findOrFail($request->currency);
        if (!$currency) {
            return response()->json([
                'message' => "Currency not found.",
                'success' => false
            ]);
        }

        $data['amount_paid_usd'] = $request->amount_paid / $currency->exchange_rate;

        try {
            $systemCharge = SystemCharge::find($request->system_charges);
            $currency = Currency::find($request->currency);

            if (!$systemCharge || !$currency) {
                return response()->json([
                    'message' => 'System charge or currency not found',
                    'success' => false
                ]);
            }

            $CurrencyId = 2; // Define a named constant or variable
            if ($systemCharge->name === 'ZAR' && $currency->name === 'USD') {
                $exchangeRate = Currency::find($CurrencyId)->exchange_rate;
                if ($exchangeRate === 0) {
                    throw new \Exception('Exchange rate cannot be zero');
                }
                $data['commission_usd'] = round(($request->amount_paid * $exchangeRate) - $request->system_charge_amount / $exchangeRate, 2);
            } elseif ($systemCharge->name === 'USD' && $currency->name === 'USD') {
                $data['commission_usd'] = round($request->amount_paid - $request->system_charge_amount, 2);
            } else {
                return response()->json([
                    'message' => "The given data is incorrect. Please check System Charge and Your Payment Currency.",
                    'success' => false
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false
            ], 500);
        }

        $dstvTransaction->update($data);

       // $message = '$'.$request->amount_paid.' on DSTV Account '.$request->dstv_account_number.' with Package '.$dstv_packages->name;
        $message = sprintf(
            'Payment update of $%s received on DSTV Account %s with Package %s.',
            $request->amount_paid,
            $request->dstv_account_number,
            $dstv_packages->name
        );
        // digital receipt msg
        $digitalReceiptController = new DigitalReceiptsMessagingController();
        $sms = $digitalReceiptController->sendDigitalReceipt($data['phone'], $data['amount_paid'], $message);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true,
            'sms'     => $sms
        ]);
    }

    public function list_dstv_transaction(Request $request,$id = null){
        if($id == null) {
            $data = DSTVTransaction::all();
        }else{
            $data = DSTVTransaction::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_dstv_transaction_by_user_id(Request $request,$user_id = null){
        if($user_id == null) {
            return response()->json([
                'message' => "User can't be null",
                'success' => false
            ],500);
        }else{
            $data = DSTVTransaction::query()->where("created_by",$user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_dstv_transaction(Request $request,$id){
        $dstvTransaction = DSTVTransaction::findOrFail($id);
        $dstvTransaction->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
