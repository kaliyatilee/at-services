<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DSTVTransaction;
use App\Models\InsurancePayment;
use App\Models\InsuranceTransaction;
use Illuminate\Http\Request;

class InsurancePaymentController extends Controller
{

    public function view(Request $request){

        $insurance_payment = InsurancePayment::all();

        $data['insurance_payment'] = $insurance_payment;
        return view('insurance.transaction.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $insurance_payment = InsurancePayment::findOrFail($id);
            $data['insurance_payment'] = $insurance_payment;
        }else{
            $data['insurance_payment'] = new InsurancePayment();
        }

        return view('insurance.transaction.add',$data);
    }

    public function create_insurance_payment(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "insurance_transaction_id" => ['required','numeric'],
            "amount" => "required|numeric|min:1"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $data['created_by'] = auth()->user()->id;

        $insuranceTransaction = InsuranceTransaction::findOrFail($data['insurance_transaction_id']);

        $data['amount_before'] = $insuranceTransaction->balance;
        $data['amount_after'] = $insuranceTransaction->balance - $data['amount'];

        $insuranceTransaction->update([
           "balance" => $data['amount_after']
        ]);

        $insurancePayment = new InsurancePayment();
        $insurancePayment->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_insurance_payment(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            "insurance_transaction_id" => ['required','numeric'],
            "amount" => "required|numeric|min:1"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $insurancePayment = InsurancePayment::findOrFail($id);
        $insurancePayment->update($data);

        return response()->json([
            'message' => "Can't update",
            'success' => false
        ]);
    }

    public function list_insurance_payment(Request $request,$id = null){
        if($id == null) {
            $data = InsurancePayment::all();
        }else{
            $data = InsurancePayment::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_insurance_payment(Request $request,$id){
        $insurancePayment = InsurancePayment::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
