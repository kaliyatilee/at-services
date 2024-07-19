<?php

namespace App\Http\Controllers\Zinara;

use App\Http\Controllers\Controller;
use App\Models\Zinara\RemittanceRecord;
use Illuminate\Http\Request;

class RemittanceRecordController extends Controller
{

    public function view(Request $request)
    {

        $remittance_record = RemittanceRecord::all();

        $data['remittance_record'] = $remittance_record;
        return view('zinara.remittance.list', $data);
    }



    public function create_record(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "vehicle_transaction_name" => 'nullable', 'string',
            "expected_amount_usd" => "nullable|numeric",
            "date_of_remittance" => "nullable|date",
            "method_of_remittance" => "nullable|string",
            "amount_remitted_zig" => "nullable|numeric",
            "amount_remitted_usd" => "nullable|numeric",
            "account_balance_usd" => "nullable|numeric",
            "account_balance_zig" => "nullable|numeric",
            "expected_amount_zig" => "nullable|numeric",
      
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $data = $validator->validated();
    
        $remittance_record = RemittanceRecord::create($data);
    
        return response()->json([
            'success' => true,
            'message' => "Saved successfully",
            'remittance_record' => $remittance_record,
        ], 201);
    }
    
    public function update(Request $request, $id)
{
    $validator = validator()->make($request->all(), [
        "vehicle_transaction_name" => 'nullable|string',
        "date_of_remittance" => "nullable|date",
        "method_of_remittance" => "nullable|string",
        "amount_remitted_zig" => "nullable|numeric",
        "amount_remitted_usd" => "nullable|numeric",
        "account_balance_usd" => "nullable|numeric",
        "account_balance_zig" => "nullable|numeric",
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $data = $validator->validated();

    $remittance_record = RemittanceRecord::findOrFail($id);

    $jsonFields = [
        'date_of_remittance',
        'method_of_remittance',
        'amount_remitted_zig',
        'amount_remitted_usd',
        'account_balance_usd',
        'account_balance_zig',
    ];

    foreach ($jsonFields as $field) {
        if (isset($data[$field])) {
            $currentValue = $remittance_record->$field ?? [];
            if (!is_array($currentValue)) {
                $currentValue = [];
            }
            $currentValue[] = $data[$field];
            $remittance_record->$field = $currentValue;
        }
    }

    if (isset($data['vehicle_transaction_name'])) {
        $remittance_record->vehicle_transaction_name = $data['vehicle_transaction_name'];
    }

    $remittance_record->save();

    return response()->json([
        'message' => "Updated successfully",
        'success' => true,
        'remittance_record' => $remittance_record
    ]);
}
    

    public function edit(Request $request, $id)
{

    $remittance = RemittanceRecord::findOrFail($id);

    $data = [
        'remittance' => $remittance

    ];

    if ($request->wantsJson()) {
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'success' => true,
        ]);
    }

    return view('zinara.remittance.edit', $data);
}


    public function detail(Request $request, $id)
{
  
    $remittance = RemittanceRecord::findOrFail($id);

    $data = [
        'remittance' => $remittance
    ];

    if ($request->wantsJson()) {
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'success' => true
        ]);
    }
    //dd($remittance->toArray());
    return view('zinara.remittance.view', $data);
}


    public function delete_zinara_transaction(Request $request, $id)
    {
        $remittance_record = RemittanceRecord::findOrFail($id);
        $remittance_record->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
