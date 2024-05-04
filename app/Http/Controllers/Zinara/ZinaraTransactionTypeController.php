<?php

namespace App\Http\Controllers\Zinara;

use App\Http\Controllers\Controller;
use App\Models\Ecocash\EcocashTransactionType;
use App\Models\Zinara\ZinaraTransactionType;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ZinaraTransactionTypeController extends Controller
{
    public function view(Request $request){

        $ecocash_transaction_types = EcocashTransactionType::all();

        $data['ecocash_transaction_types'] = $ecocash_transaction_types;
        return view('ecocash.transaction_type.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $ecocash_transaction_type = EcocashTransactionType::findOrFail($id);
            $data['ecocash_transaction_type'] = $ecocash_transaction_type;
        }else{
            $data['ecocash_transaction_type'] = new EcocashTransactionType();
        }

        return view('ecocash.transaction_type.add',$data);
    }

    public function create_zinara_transaction_type(Request $request)
    {
        $data = $request->validate([
            "name" => ["required","string",Rule::unique("zinara_ctransaction_type")],
            "notes" => "nullable|string",
        ]);

        $data['created_by'] = auth()->user()->id;

        $ecocashTransactionType = new ZinaraTransactionType();
        $ecocashTransactionType->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_zinara_transaction_type(Request $request,$id)
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

    public function list_zinara_transaction_type(Request $request,$id = null){
        if($id == null) {
            $data = ZinaraTransactionType::all();
        }else{
            $data = ZinaraTransactionType::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_zinara_transaction_type(Request $request,$id){
        $insurancePayment = ZinaraTransactionType::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
