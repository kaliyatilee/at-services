<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBroker;
use App\Models\InsurancePayment;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use Illuminate\Http\Request;

class InsuranceBrokerController extends Controller
{

    public function view(Request $request){

        $insurance_brokers = InsuranceBroker::all();

        $data['insurance_brokers'] = $insurance_brokers;
        return view('insurance.broker.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $insurance_broker = InsuranceTransaction::findOrFail($id);
            $data['insurance_broker'] = $insurance_broker;
        }else{
            $data['insurance_broker'] = new InsuranceBroker();
        }

        return view('insurance.broker.add',$data);
    }

    public function insurance_broker_edit($id)
    {
        $insurance_broker = InsuranceBroker::findOrFail($id);
        $transactions = $insurance_broker->transactions;
    
        return view('insurance.broker.edit', [
            'insurance_broker' => $insurance_broker,
            'transactions' => $transactions
        ]);
    }
    


	public function insurance_broker_view($id)
	{
		$insurance_broker = InsuranceBroker::findOrFail($id);
        $data['insurance_broker'] = $insurance_broker;

        return view('insurance.broker.view',$data);
	}

    public function create_insurance_broker(Request $request)
{
    $data = $request->validate([
        "name" => "required|string|min:1",
        "commission" => "required|numeric",
        "notes" => "nullable|string",
        "date_of_remittance" => "required|date",
        "method_of_remittance" => "required|string",
        "amount_remitted" => "nullable|numeric",
        "account_balance" => "nullable|numeric",
        "total_remittance" => "nullable|numeric",
        "remittance" => "nullable|numeric"
    ]);

    $data['created_by'] = auth()->user()->id;

    // Convert fields to arrays
    $data['date_of_remittance'] = [$data['date_of_remittance']];
    $data['method_of_remittance'] = [$data['method_of_remittance']];
    $data['amount_remitted'] = isset($data['amount_remitted']) ? [$data['amount_remitted']] : [];
    $data['account_balance'] = isset($data['account_balance']) ? [$data['account_balance']] : [];
    $data['remittance'] = isset($data['remittance']) ? [$data['remittance']] : [];

    $insuranceBroker = InsuranceBroker::create($data);

    return response()->json([
        'message' => "Saved successfully",
        'success' => true,
        'data' => $insuranceBroker
    ]);
}


public function update_insurance_broker(Request $request, $id)
{
    $data = $request->validate([
        "name" => "required|string|min:1",
        "commission" => "required|numeric",
        "notes" => "nullable|string",
        "date_of_remittance" => "required|date",
        "method_of_remittance" => "required|string",
        "amount_remitted" => "required|numeric",
        "account_balance" => "required|numeric",
        "total_remittance" => "nullable|numeric",
        "remittance" => "nullable|numeric"
    ]);

    $insuranceBroker = InsuranceBroker::findOrFail($id);

    // Update name, commission, notes, and total_remittance directly
    $insuranceBroker->name = $data['name'];
    $insuranceBroker->commission = $data['commission'];
    $insuranceBroker->notes = $data['notes'];
    $insuranceBroker->total_remittance = $data['total_remittance'];

    // Merge new values into JSON fields
    $remittance = $insuranceBroker->remittance ?? [];
    if (isset($data['remittance'])) {
        $remittance[] = $data['remittance'];
    }

    $dateOfRemittance = $insuranceBroker->date_of_remittance ?? [];
    if (isset($data['date_of_remittance'])) {
        $dateOfRemittance[] = $data['date_of_remittance'];
    }

    $methodOfRemittance = $insuranceBroker->method_of_remittance ?? [];
    if (isset($data['method_of_remittance'])) {
        $methodOfRemittance[] = $data['method_of_remittance'];
    }

    $amountRemitted = $insuranceBroker->amount_remitted ?? [];
    if (isset($data['amount_remitted'])) {
        $amountRemitted[] = $data['amount_remitted'];
    }

    $accountBalance = $insuranceBroker->account_balance ?? [];
    if (isset($data['account_balance'])) {
        $accountBalance[] = $data['account_balance'];
    }

    // Update JSON fields
    $insuranceBroker->remittance = $remittance;
    $insuranceBroker->date_of_remittance = $dateOfRemittance;
    $insuranceBroker->method_of_remittance = $methodOfRemittance;
    $insuranceBroker->amount_remitted = $amountRemitted;
    $insuranceBroker->account_balance = $accountBalance;    

    $insuranceBroker->save();

    return response()->json([
        'message' => "Updated successfully",
        'success' => true
    ]);
}


    public function list_insurance_broker(Request $request)
    {
        $data = InsuranceBroker::all();

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_insurance_broker(Request $request, $id)
    {
        $insurancePayment = InsuranceBroker::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
