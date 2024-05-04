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

    public function create_insurance_broker(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|min:1",
            "commission" => "required|numeric",
            "notes" => "nullable|string",
        ]);

        $data['created_by'] = auth()->user()->id;

        $insuranceBroker = new InsuranceBroker();
        $insuranceBroker->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_insurance_broker(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "required|string|min:1",
            "commission" => "required|numeric",
            "notes" => "nullable|string",
        ]);

        $insuranceBroker = InsuranceBroker::findOrFail($id);
        $insuranceBroker->update($data);

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
