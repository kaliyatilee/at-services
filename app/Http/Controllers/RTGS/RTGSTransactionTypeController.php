<?php

namespace App\Http\Controllers\RTGS;

use App\Http\Controllers\Controller;
use App\Models\Ecocash\EcocashTransactionType;
use App\Models\Ecocash\ZinaraTransactionType;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\RTGS\RTGSTransactionType;
use App\Models\VehicleClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RTGSTransactionTypeController extends Controller
{
    public function view(Request $request){

        $rtgs_transaction_types = RTGSTransactionType::all();

        $data['rtgs_transaction_types'] = $rtgs_transaction_types;
        return view('rtgs.transaction_type.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $rtgs_transaction_type = RTGSTransactionType::findOrFail($id);
            $data['ecocash_transaction_type'] = $rtgs_transaction_type;
        }else{
            $data['ecocash_transaction_type'] = new RTGSTransactionType();
        }

        return view('ecocash.transaction_type.add',$data);
    }

    public function create_rtgs_transaction_type(Request $request)
    {
        $data = $request->validate([
            "name" => ["required","string",Rule::unique("zinara_ctransaction_type")],
            "notes" => "nullable|string",
        ]);

        $data['created_by'] = auth()->user()->id;

        $ecocashTransactionType = new RTGSTransactionType();
        $ecocashTransactionType->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_rtgs_transaction_type(Request $request,$id)
    {
        $data = $request->validate([
            "name" => ["required","string"],
            "notes" => "nullable|string",
        ]);

        $ecocashTransactionType = ZinaraTransactionType::findOrFail($id);
        $ecocashTransactionType->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_rtgs_transaction_type(Request $request,$id = null){
        if($id == null) {
            $data = RTGSTransactionType::all();
        }else{
            $data = RTGSTransactionType::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_rtgs_transaction_type(Request $request,$id){
        $insurancePayment = RTGSTransactionType::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
