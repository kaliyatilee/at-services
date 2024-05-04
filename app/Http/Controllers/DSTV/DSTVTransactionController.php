<?php

namespace App\Http\Controllers\DSTV;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Currency;
use App\Models\DSTVPackage;
use App\Models\DSTVTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use function response;

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

        return view('dstv.transaction.add',$data);
    }

    public function create_dstv_transaction(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|min:1",
            "phone" => "nullable|string|min:1",
            "amount_paid" => "nullable|string|min:1",
            "expected_amount" => "nullable|string|min:1",
            "rate" => "nullable|string",
            "currency_id" => "nullable|numeric|min:1",
            "dstv_account_number" => "nullable|string",
            "package_id" => "nullable|numeric",
            "notes" => "nullable|string"
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
        $data['created_by'] = Auth::user()->id;
        $data['commission_usd'] = 0;

        $dstvTransaction = new DSTVTransaction();
        $dstvTransaction->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_dstv_transaction(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "amount_paid" => "nullable|string|min:1",
            "expected_amount" => "nullable|string|min:1",
            "rate" => "nullable|string",
            "currency_id" => "nullable|numeric|min:1",
            "dstv_account_number" => "nullable|string|min:5",
            "package_id" => "nullable|numeric",
            "notes" => "nullable|string",
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

        $dstvTransaction = DSTVTransaction::findOrFail($id);
        $dstvTransaction->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
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
