<?php

namespace App\Http\Controllers\GeneralSales;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Ecocash\Ecocash;
use App\Models\Ecocash\EcocashAgentLine;
use App\Models\Ecocash\EcocashTransactionType;
use App\Models\GeneralSales\GeneralSale;
use App\Models\GeneralSales\GeneralSaleTransactionType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GeneralSalesController extends Controller
{
    public function view(Request $request){

        $general_sales = Ecocash::all();

        $data['general_sales'] = $general_sales;
        return view('general_sales.transaction.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $general_sale = GeneralSale::findOrFail($id);
            $data['general_sale'] = $general_sale;
        }else{
            $data['general_sale'] = new GeneralSale();
        }

        $data['currencies'] = Currency::all();
        $data['transaction_types'] = GeneralSaleTransactionType::all();

        return view('general_sales.transaction.add',$data);
    }

    public function create_general_sale(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => ["nullable","string"],
            "description" => ["nullable","string"],
            "payment_type" => ["nullable","string"],
            "currency" => ["nullable","numeric"],
            "amount" => ["nullable","numeric"],
            "phone" => ["nullable","string"],
            "transaction_type" => ["nullable","numeric"],
            "notes" => "nullable|string",
            "created_by" => "numeric"
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

        $generalSale = new GeneralSale();
        $generalSale->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_general_sale(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            "name" => ["nullable","string"],
            "description" => ["nullable","string"],
            "payment_type" => ["nullable","string"],
            "currency" => ["nullable","numeric"],
            "amount" => ["nullable","numeric"],
            "phone" => ["nullable","string"],
            "transaction_type" => ["nullable","numeric"],
            "notes" => "nullable|string"
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

        $ecocash = GeneralSale::findOrFail($id);
        $ecocash->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_general_sale(Request $request,$id = null){
        if($id == null) {
            $data = GeneralSale::all();
        }else{
            $data = GeneralSale::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_general_sale_by_user(Request $request,$user_id = null){
        if($user_id == null) {
            $data = GeneralSale::all();
        }else{
            $data = GeneralSale::query()->where("created_at",$user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_general_sale(Request $request,$id){
        $insurancePayment = GeneralSale::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
