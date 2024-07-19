<?php

namespace App\Http\Controllers\Zinara;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use App\Models\Currency;
use App\Models\Zinara\ZinaraTransactionType;
use App\Models\Zinara\ZinaraTransaction;
use App\Models\Zinara\RemittanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZinaraTransactionController extends Controller
{

    public function view(Request $request)
    {

        $zinara_transaction = ZinaraTransaction::all();

        $data['zinara_transaction'] = $zinara_transaction;
        return view('zinara.transaction.list', $data);
    }

    public function add(Request $request, $id = null)
    {
        if ($id != null) {
            $zinara_insurance = ZinaraTransaction::findOrFail($id);
            $data['zinara_transaction'] = $zinara_insurance;
        } else {
            $data['zinara_transaction'] = new ZinaraTransaction();
        }
    
        $data['vehicle_classes'] = VehicleClass::all();
        $data['currencies'] = Currency::all();
        $data['transaction_types'] = ZinaraTransactionType::all();
    
        if ($request->wantsJson()) {
            return response()->json([
                'data' => $data,
                'message' => 'Success',
                'success' => true
            ]);
        }
    
        return view('zinara.vehicle_licence_transactions.add', $data);
    }
    
    public function create_zinara_transaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ['nullable', 'string'],
            "phone" => ['nullable', 'string'],
            "vehicle_class" => "nullable|numeric",
            "reg_no" => "nullable|string|min:7|max:7",
            "expiry_date" => "nullable|date",
            "amount_paid" => "nullable|numeric",
            "expected_amount" => "nullable|numeric",
            "date_of_transaction" => "nullable|date",
            "currency" => "nullable|string",
            "transaction_type" => "nullable|string",
            "amount_paid_zig" => "nullable|numeric",
            "expected_amount_zig" => "nullable|numeric",
            "remittance_table" => "nullable|numeric",
            "rate" => "nullable|numeric",
            "notes" => "nullable|string",
            "created_by" => "nullable|numeric"
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        $data = $validator->validated();
        $data['created_by'] = auth()->user()->id;
    
        $remittanceRecord = RemittanceRecord::create([
            'vehicle_transaction_name' => $data['name'],
            'expected_amount_zig' => $data['expected_amount_zig'] ?? null,
            'expected_amount_usd' => $data['expected_amount'] ?? null,
          
            'date_of_remittance' => [],
            'method_of_remittance' => [],
            'amount_remitted_zig' => [],
            'amount_remitted_usd' => [],
            'account_balance_zig' => [],
            'account_balance_usd' => [],
        ]);
    
        $data['remittance_table'] = $remittanceRecord->id;
    
        $zinaraTransaction = ZinaraTransaction::create($data);
    
        return response()->json([
            'success' => true,
            'message' => "Saved successfully",
            'zinaraTransaction' => $zinaraTransaction,
            'remittanceRecord' => $remittanceRecord,
        ], 201);
    }
    
    public function update_zinara_transaction(Request $request, $id)
{
    $validator = validator()->make($request->all(), [
        "name" => ['nullable', 'string'],
        "phone" => ['nullable', 'string'],
        "class" => "nullable|numeric",
        "reg_no" => "nullable|string|min:7|max:7",
        "expiry_date" => "nullable|date",
        "amount_paid" => "nullable|numeric",
        "expected_amount" => "nullable|numeric",
        "date_of_transaction" => "nullable|date",
        "currency" => "nullable|string",
        "transaction_type" => "nullable|string",
        "amount_paid_zig" => "nullable|numeric",
        "expected_amount_zig" => "nullable|numeric",
        "remittance_table" => "nullable|numeric",
        "rate" => "nullable|numeric",
        "notes" => "nullable|string"
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $data = $validator->validated();

    $zinaraTransaction = ZinaraTransaction::findOrFail($id);
    $zinaraTransaction->update($data);

    if ($zinaraTransaction->remittance_table) {
        $remittanceRecord = RemittanceRecord::findOrFail($zinaraTransaction->remittance_table);

        if (isset($data['expected_amount_zig'])) {
            $remittanceRecord->expected_amount_zig = $remittanceRecord->expected_amount_zig 
                ? $remittanceRecord->expected_amount_zig + $data['expected_amount_zig']
                : $data['expected_amount_zig'];
        }

        if (isset($data['expected_amount'])) {
            $remittanceRecord->expected_amount_usd = $remittanceRecord->expected_amount_usd 
                ? $remittanceRecord->expected_amount_usd + $data['expected_amount']
                : $data['expected_amount'];
        }

        $remittanceRecord->save();
    }

    return response()->json([
        'message' => "Updated successfully",
        'success' => true,
        'zinaraTransaction' => $zinaraTransaction,
        'remittanceRecord' => $remittanceRecord ?? null,
    ]);
}
    

    public function edit(Request $request, $id)
{
  
    $zinara_transaction = ZinaraTransaction::findOrFail($id);

    $vehicle_classes = VehicleClass::all();
    $currency_classes = Currency::all();
    $currency_classes = Currency::all();
    $transaction_classes = ZinaraTransactionType::all();
 
    $data = [
        'zinara_transaction' => $zinara_transaction,
        'vehicle_classes' => $vehicle_classes,
        'currencies' => $currency_classes,
        'transaction_types' => $transaction_classes

    ];

    if ($request->wantsJson()) {
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'success' => true,
        ]);
    }

    return view('zinara.vehicle_licence_transactions.edit', $data);
}


    public function list_zinara_transaction(Request $request, $id = null)
    {
        if ($id == null) {
            $data = ZinaraTransaction::all();
        } else {
            $data = ZinaraTransaction::query()->where("id", $id)->first();
        }

        return view('zinara.vehicle_licence_transactions.list', [
            'data' => $data,
        ]);
    }

    public function list_zinara_transaction_by_user_id(Request $request, $user_id = null)
    {
        if ($user_id == null) {
            $data = ZinaraTransaction::all();
        } else {
            $data = ZinaraTransaction::query()->where("created_by", $user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function detail(Request $request, $id)
{

    $zinara_transaction = ZinaraTransaction::findOrFail($id);

    $data = [
        'zinara_transaction' => $zinara_transaction
    ];

    if ($request->wantsJson()) {
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'success' => true
        ]);
    }

    return view('zinara.vehicle_licence_transactions.view', $data);
}


    public function delete_zinara_transaction(Request $request, $id)
    {
        $insurancePayment = ZinaraTransaction::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
