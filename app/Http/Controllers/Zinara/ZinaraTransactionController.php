<?php

namespace App\Http\Controllers\Zinara;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use App\Models\Currency;
use App\Models\Zinara\ZinaraTransactionType;
use App\Models\Zinara\ZinaraTransaction;
use Illuminate\Http\Request;

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
    
        // Create a new ZinaraTransaction instance
        $zinaraTransaction = ZinaraTransaction::create($data);
    
        // Log a message to the terminal
        Log::info('ZinaraTransaction created:', $data);
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => "Saved successfully",
            'zinaraTransaction' => $zinaraTransaction,
        ], 201);
    }
    
    public function updateZinaraTransaction(Request $request, $id)
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
    
        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }
    

    public function edit(Request $request, $id)
{
    // Fetch the specific ZinaraTransaction to be edited
    $zinara_transaction = ZinaraTransaction::findOrFail($id);

    // Fetch all vehicle classes
    $vehicle_classes = VehicleClass::all();
    $currency_classes = Currency::all();
    $currency_classes = Currency::all();
    $transaction_classes = ZinaraTransactionType::all();
    // Prepare data to be passed to the view
    $data = [
        'zinara_transaction' => $zinara_transaction,
        'vehicle_classes' => $vehicle_classes,
        'currencies' => $currency_classes,
        'transaction_types' => $transaction_classes

    ];

    // If the request expects a JSON response, return the data as JSON
    if ($request->wantsJson()) {
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'success' => true,
        ]);
    }

    // Render the view and pass the data
    return view('zinara.vehicle_licence_transactions.edit', $data);
}


    public function list_zinara_transaction(Request $request, $id = null)
    {
        if ($id == null) {
            $data = ZinaraTransaction::all();
        } else {
            $data = ZinaraTransaction::query()->where("id", $id)->first();
        }
    
        // Render the view
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
    // Fetch the specific ZinaraTransaction by ID
    $zinara_transaction = ZinaraTransaction::findOrFail($id);

    // Prepare data to be passed to the view
    $data = [
        'zinara_transaction' => $zinara_transaction
    ];

    // If the request expects a JSON response, return the data as JSON
    if ($request->wantsJson()) {
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'success' => true
        ]);
    }

    // Render the detail view and pass the data
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
