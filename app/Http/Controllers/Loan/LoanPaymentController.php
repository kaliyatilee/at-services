<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\DSTVTransaction;
use App\Models\LoanDisbursed;
use App\Models\LoanPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\Messaging\Http\Controllers\DigitalReceiptsMessagingController;

class LoanPaymentController extends Controller
{
    public function create_loan_payment(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "installment_payment_date" => "required|date",
            "installment_amount_paid" => "required|numeric",
            "currency_rate" => "required",
            "expense"       => "nullable",
            "expense_amount" => "nullable|numeric",
            "notes"     => "nullable"
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $created_by= 1;//Auth::user()->id;
        $loanDisbursed = LoanDisbursed::findOrFail($request->loan_id);
        $installments = LoanPayment::where('loan_id', $request->loan_id)->sum('installment_amount_paid');
        $amount_disbursed = $loanDisbursed->amount;
        $commission = $request->installment_amount_paid - $amount_disbursed - $request->expense_amount;
        $phone = $loanDisbursed->phone;
        $currency = Currency::findOrFail($loanDisbursed->currency_id)->name;
        $amount_before = $installments ? $amount_disbursed - $installments : $amount_disbursed;

        /* if ($installments >= $amount_disbursed) {
            return response()->json([
                'message' => 'Loan has been paid in full.',
                'status' => 'paid_in_full',
                'success' => true
            ], 200);
        } */

       LoanPayment::create([
            "loan_id"                   => $request->loan_id,
            "amount"                    => $request->installment_amount_paid,
            "amount_before"             => $amount_before,
            "amount_after"              => $amount_before - $request->installment_amount_paid,
            "installment_payment_date"  => $request->installment_payment_date,
            "installment_amount_paid"   => $request->installment_amount_paid,
            "currency_rate"             => $request->currency_rate,
            "notes"                     => $request->notes,
            "expense"                   => $request->expense,
            "expense_amount"            => $request->expense_amount,
            "created_by"                => $created_by
        ]);

        $message = sprintf(
            'A payment of %s%.2f has been debited from your outstanding loan balance of %s%.2f. Your new outstanding loan balance is %s%.2f.',
            $currency,
            $request->installment_amount_paid,
            $currency,
            $amount_before,
            $currency,
            $amount_before - $request->installment_amount_paid
        );
        // digital receipt msg
        $digitalReceiptController = new DigitalReceiptsMessagingController();
        $sms = $digitalReceiptController->sendDigitalReceipt($phone, $amount_before, $message);

        return response()->json([
            'message' => "Saved successfully",
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
            'message' => "Can't updates",
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
