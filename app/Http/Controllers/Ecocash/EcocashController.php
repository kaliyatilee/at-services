<?php

namespace App\Http\Controllers\Ecocash;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Ecocash\Ecocash;
use App\Models\Ecocash\EcocashAgentLine;
use App\Models\Ecocash\EcocashTransactionType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EcocashController extends Controller
{
    public function view(Request $request){

        $ecocashs = Ecocash::all();

        $data['ecocashs'] = $ecocashs;
        return view('ecocash.transaction.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $ecocash = Ecocash::findOrFail($id);
            $data['ecocash'] = $ecocash;
        }else{
            $data['ecocash'] = new Ecocash();
        }

        $data['currencies'] = Currency::all();
        $data['transaction_types'] = EcocashTransactionType::all();
        $data['ecocash_agent_lines'] = EcocashAgentLine::all();

        return view('ecocash.transaction.add',$data);
    }

    public function create_ecocash(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => ["nullable","string"],
            "description" => ["nullable","string"],
            "currency" => ["nullable","numeric"],
            "amount_paid" => ["nullable","numeric"],
            "expected_amount" => ["nullable","numeric"],
            "phone" => ["nullable","string"],
            "agent_line" => ["nullable","numeric"],
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

        $ecocash = new Ecocash();
        $ecocash->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_ecocash(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            "name" => ["nullable","string"],
            "description" => ["nullable","string"],
            "currency" => ["nullable","numeric"],
            "amount_paid" => ["nullable","numeric"],
            "expected_amount" => ["nullable","numeric"],
            "phone" => ["nullable","string"],
            "agent_line" => ["nullable","numeric"],
            "transaction_type" => ["nullable","numeric"],
            "notes" => "nullable|string",
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

        $ecocash = Ecocash::findOrFail($id);
        $ecocash->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_ecocash(Request $request,$id = null){
        if($id == null) {
            $data = Ecocash::all();
        }else{
            $data = Ecocash::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_ecocash_by_user(Request $request,$user_id = null){
        if($user_id == null) {
            $data = Ecocash::all();
        }else{
            $data = Ecocash::query()->where("created_by",$user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function summary(Request $request,$user_id,$start_date,$end_date){

        $start_date = date('Y-m-d H:i:s', strtotime($start_date . " 00:00:00"));
        $end_date = date('Y-m-d H:i:s', strtotime($end_date . " 23:59:59"));

        $data = Ecocash::query()->whereBetween("created_at",[$start_date,$end_date])->where("created_by",$user_id)->get();

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_ecocash(Request $request,$id){
        $insurancePayment = Ecocash::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
