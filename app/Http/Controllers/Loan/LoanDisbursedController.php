<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Currency;
use App\Models\InsuranceBroker;
use App\Models\LoanDisbursed;
use App\Models\LoanPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Messaging\Http\Controllers\DigitalReceiptsMessagingController;

class LoanDisbursedController extends Controller
{
    public function view(Request $request)
    {
        $loan_disbursed = LoanDisbursed::all();

        $data['loan_disbursed'] = $loan_disbursed;
        return view('loan.list', $data);
    }

    public function add(Request $request, $id = null)
    {

        if ($id != null) {
            $client = LoanDisbursed::findOrFail($id);
            $data['loan_disbursed'] = $client;
        } else {
            $data['loan_disbursed'] = new LoanDisbursed();
        }

        $data['currencies'] = Currency::all();

        return view('loan.add', $data);
    }


    public function loan_disbursed_edit($id){
        $loan = LoanDisbursed::findOrFail($id);
        $payments = LoanPayment::where('loan_id',$id)->get();
        $currencies = Currency::all();
        $installments = LoanPayment::where('loan_id', $id)->sum('installment_amount_paid');
        $total_expenses = LoanPayment::where('loan_id', $id)->sum('expense_amount');

        $commission = $installments - $loan->amount - $total_expenses;
        $commission_usd = $commission;

        return view('loan.edit', compact('loan', 'installments', 'total_expenses', 'currencies', 'payments', 'commission', 'commission_usd'));

	}


	public function loan_disbursed_view($id){
        $loans = LoanDisbursed::findOrFail($id);
        $data['loan'] = $loans;
        $data['currencies'] = Currency::all();
        return view('loan.view', $data);

	}

    public function create_loan_disbursed(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "required|string|min:1",
            "phone" => "required|string|min:1",
            "amount" => "required|numeric|min:1",
            "currency_id" => "nullable|numeric|min:1",
            "rate_per_week" => "required|numeric|min:1",
            "repayment_date" => "required|date",
            "expense_amount"   => "required|numeric",
            "collateral" => "nullable|string",
            "notes" => "nullable|string",
            "created_by" => "numeric",
			"currency_id" =>"numeric",
			"transaction_date" => "nullable|date"
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
		$data['created_by']=isset($data['created_by']) ? $data['created_by'] : Auth::user()->id;
		$data['currency_id']=intval(isset($data['currency_id']));
		$data['amount']= doubleval(isset($data['amount'])) ? $data['amount'] : 0;
		$data['rate_per_week']= doubleval(isset($data['rate_per_week'])) ? $data['rate_per_week'] : 0;

        $currency = Currency::findOrFail($request->currency_id);

        // if ($request->hasFile("collateral")) {
        //     $collateralFile = $request->file('collateral');
        //     $path = $collateralFile->store('/collateral/');
        //     $data['collateral'] = $path;
        // }

        $loanDisbursed = new LoanDisbursed();
        $loanDisbursed->create($data);

        $message = sprintf(
            'Loan of %s%s has been disbursed to %s with Account Number %s. Loan payable %s at Rate-Per-Week of %s.',
            $currency->name,
            $request->amount,
            $request->name,
            $request->phone,
            $request->repayment_date,
            $request->rate_per_week,
        );
        // digital receipt msg
        $digitalReceiptController = new DigitalReceiptsMessagingController();
        $sms = $digitalReceiptController->sendDigitalReceipt($data['phone'], $data['amount'], $message);


        return response()->json([
            'message' => "Saved successfully",
            'success' => true,
            'sms'      => $sms
        ]);
    }

    public function update_loan_disbursed(Request $request, $id)
    {
        $data = $request->validate([
			"name" => "required|string|min:1",
            "phone" => "required|string|min:1",
            "amount" => "required|numeric|min:1",
            "currency_id" => "nullable|numeric|min:1",
            "rate_per_week" => "required|numeric|min:1",
            "repayment_date" => "required|date",
            "collateral" => "nullable|string",
            "notes" => "nullable|string",
            "created_by" => "numeric",
			"currency_id" =>"numeric",
			"transaction_date" => "nullable|date"
        ]);

        $loanDisbursed = LoanDisbursed::findOrFail($id);
        $currency = Currency::findOrFail($request->currency_id);
		$data['currency_id']=intval(isset($data['currency_id']));
        $loanDisbursed->update($data);

        $message = sprintf(
            'Loan update of %s%s has been processed for %s with Account Number %s. Loan payable %s at Rate-Per-Week of %s.',
            $currency->name,
            $request->amount,
            $request->name,
            $request->phone,
            $request->repayment_date,
            $request->rate_per_week,
        );
        // digital receipt msg
        $digitalReceiptController = new DigitalReceiptsMessagingController();
        $sms = $digitalReceiptController->sendDigitalReceipt($data['phone'], $data['amount'], $message);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true,
            'sms'     => $sms
        ]);
    }

    public function list_loan_disbursed(Request $request, $user_id = null)
    {
        if ($user_id == null) {
            $data = LoanDisbursed::all();
        } else {
            $data = LoanDisbursed::query()->where("created_by", $user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_loan_disbursed(Request $request, $id)
    {
        $loanDisbursed = LoanDisbursed::findOrFail($id);
        $loanDisbursed->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }

    public function loan_check(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "amount" => "nullable|numeric|min:1"
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $loanDisbursed = LoanDisbursed::query()->where("phone",$data['phone'])->where("amount",$data['amount'])->get();

        return response()->json([
            'message' => "Done",
            'data' => $loanDisbursed,
            'success' => true
        ]);
    }
}
