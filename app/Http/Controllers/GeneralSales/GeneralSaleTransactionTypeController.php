<?php

namespace App\Http\Controllers\GeneralSales;

use App\Http\Controllers\Controller;
use App\Models\Ecocash\EcocashTransactionType;
use App\Models\GeneralSales\GeneralSaleTransactionType;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GeneralSaleTransactionTypeController extends Controller
{
    public function view(Request $request){

        $general_sales_transaction_types = EcocashTransactionType::all();

        $data['general_sales_transaction_types'] = $general_sales_transaction_types;
        return view('general_sales.transaction_type.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $general_sale_transaction_type = GeneralSaleTransactionType::findOrFail($id);
            $data['general_sale_transaction_type'] = $general_sale_transaction_type;
        }else{
            $data['general_sale_transaction_type'] = new GeneralSaleTransactionType();
        }

        return view('general_sales.transaction_type.add',$data);
    }

    public function create_general_sale_transaction_type(Request $request)
    {
        $data = $request->validate([
            "name" => ["required","string",Rule::unique("general_sale_transaction_type")],
            "notes" => "nullable|string",
        ]);

        $data['created_by'] = auth()->user()->id;

        $generalSaleTransactionType = new GeneralSaleTransactionType();
        $generalSaleTransactionType->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_general_sale_transaction_type(Request $request,$id)
    {
        $data = $request->validate([
            "name" => ["required","string"],
            "notes" => "nullable|string",
        ]);

        $generalSaleTransactionType = GeneralSaleTransactionType::findOrFail($id);
        $generalSaleTransactionType->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_general_sale_transaction_type(Request $request,$id = null){
        if($id == null) {
            $data = GeneralSaleTransactionType::all();
        }else{
            $data = GeneralSaleTransactionType::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_general_sale_transaction_type(Request $request,$id){
        $insurancePayment = GeneralSaleTransactionType::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
