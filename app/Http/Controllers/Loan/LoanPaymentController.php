<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\DSTVTransaction;
use App\Models\LoanDisbursed;
use App\Models\LoanPayment;
use Illuminate\Http\Request;

class LoanPaymentController extends Controller
{
    public function create_loan_payment(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "loan_id" => "nullable|numeric|min:1",
            "amount" => "nullable|numeric|min:1",
            "created_by" => "nullable|numeric|min:1"
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $loanDisbursed = LoanDisbursed::findOrFail($data['loan_id']);

        $data['amount_before'] = $loanDisbursed->getBalance();
        $data['amount_after'] = $data['amount_before'] - $data['amount'];

        $loanPayment = new LoanPayment();
        $loanPayment->create($data);

        return response()->json([
            'message' => "Saved successfully " . json_encode($data),
            'success' => true
        ]);
    }

    public function update_loan_payment(Request $request, $id)
    {
        $data = $request->validate([
            "loan_id" => "nullable|numeric|min:1",
            "amount" => "nullable|numeric|min:1"
        ]);

        $loanDisbursed = LoanDisbursed::findOrFail($id);

        return response()->json([
            'message' => "Can't update",
            'success' => true
        ],500);
    }

    public function list_loan_payment(Request $request,$loan_id = null)
    {
        if($loan_id == null){
            return response()->json([
                'message' => "Loan ID not specified",
                'success' => false
            ],500);
        }else{
            $data = LoanPayment::query()->where("loan_id",$loan_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_loan_payment(Request $request, $id)
    {
        $loanPayment = LoanPayment::findOrFail($id);
        $loanPayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
