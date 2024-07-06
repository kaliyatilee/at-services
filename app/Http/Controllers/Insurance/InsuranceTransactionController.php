<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Messaging\Http\Controllers\DigitalReceiptsMessagingController;

class InsuranceTransactionController extends Controller
{

    public function view(Request $request)
    {

        $insurance_transaction = InsuranceTransaction::all();

        $data['insurance_transactions'] = $insurance_transaction;
        return view('insurance.transaction.list', $data);
    }

    public function add(Request $request, $id = null)
    {

        if ($id != null) {
            $insurance_transaction = InsuranceTransaction::findOrFail($id);
            $data['insurance_transaction'] = $insurance_transaction;
        } else {
            $data['insurance_transaction'] = new InsuranceTransaction();
        }

        $data['vehicle_classes'] = VehicleClass::all();
        $data['insurance_brokers'] = InsuranceBroker::all();
        $data['currencies'] = Currency::all();
        return view('insurance.transaction.add', $data);
    }

	public function insurance_transaction_edit($id){

		$insurance_transaction = InsuranceTransaction::findOrFail($id);
		$data['insurance_transaction'] = $insurance_transaction;
        $data['vehicle_classes'] = VehicleClass::all();
        $data['insurance_brokers'] = InsuranceBroker::all();
        $data['currencies'] = Currency::all();
        return view('insurance.transaction.edit', $data);

	}

	public function insurance_transaction_view($id){

		$insurance_transaction = InsuranceTransaction::findOrFail($id);
		$data['insurance_transaction'] = $insurance_transaction;
        $data['vehicle_classes'] = VehicleClass::all();
        $data['insurance_brokers'] = InsuranceBroker::all();
        $data['currencies'] = Currency::all();
        return view('insurance.transaction.view', $data);

	}


    public function create_insurance_transaction(Request $request)

    {
        $validator = validator()->make($request->all(), [
			"name" => ['nullable', 'string'],
            "phone" => ['nullable', 'string'],
            "class" => "required|numeric",
            "insurance_broker" => "required|numeric",
            "reg_no" => "nullable|string|min:7|max:7",
            "vehicle_type" => "required|string",
            "expiry_date" => "required|date",
            "amount_paid" => "required|numeric",
            "expected_amount" => "nullable|numeric",
            "rate" => "required|numeric",
            "currency_id" => "required|numeric",
            "notes" => "nullable|string",
            "created_by" => "numeric",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }
        // Set a default value of zero for "expected_amount" if not provided

		$data = $validator->validated();
		$data['created_by'] = auth()->user()->id;

        $brokerName = InsuranceBroker::find($request->insurance_broker)->name;
        $currencyName = Currency::find($request->currency_id)->name;

        $insurancePayment = new InsuranceTransaction();
        $insurancePayment->create($data);

        $message = sprintf(
            'Insurance transaction of %s%s with %s for Vehicle Reg No. %s, expiring %s has been successful.',
            $currencyName,
            $request->amount_paid,
            $brokerName,
            $request->reg_no,
            $request->expiry_date,
        );
        // digital receipt msg
        $digitalReceiptController = new DigitalReceiptsMessagingController();
        $sms = $digitalReceiptController->sendDigitalReceipt($data['phone'], $data['amount_paid'], $message);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true,
            'sms'     => $sms
        ]);
    }

    public function update_insurance_transaction(Request $request, $id)
    {
        $validator = validator()->make($request->all(), [
            "name" => ['nullable', 'string'],
            "phone" => ['nullable', 'string'],
            "class" => "required|numeric",
            "insurance_broker" => "required|numeric",
            "reg_no" => "nullable|string|min:7|max:7",
            "vehicle_type" => "required|string",
            "expiry_date" => "required|date",
            "amount_paid" => "required|numeric",
            "expected_amount" => "nullable|numeric",
            "rate" => "required|numeric",
            "currency_id" => "required|numeric",
            "notes" => "nullable|string",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $currency = Currency::findOrFail($request->currency_id);

        $insurancePayment = InsuranceTransaction::findOrFail($id);
        $insurancePayment->update($data);


        $message = sprintf(
            'Insurance update of %s%s for Vehicle Reg No. %s, expiring %s has been successful.',
            $currency->name,
            $request->amount_paid,
            $request->reg_no,
            $request->expiry_date,
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

    public function list_insurance_transaction(Request $request, $id = null)
    {
        if ($id == null) {
            $data = InsuranceTransaction::all();
        } else {
            $data = InsuranceTransaction::query()->where("id", $id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_insurance_transaction_by_user(Request $request, $user_id = null)
    {
        if ($user_id == null) {
            $data = InsuranceTransaction::all();
        } else {
            $data = InsuranceTransaction::query()->where("user_id", $user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_insurance_transaction(Request $request, $id)
    {
        $insurancePayment = InsuranceTransaction::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
