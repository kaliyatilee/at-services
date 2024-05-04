<?php

namespace App\Http\Controllers\Zinara;

use App\Http\Controllers\Controller;
use App\Models\InsuranceBroker;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
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
        return view('zinara.transaction.add', $data);
    }

    public function create_zinara_transaction(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => ['nullable', 'string'],
            "phone" => ['nullable', 'string'],
            "class" => "nullable|numeric",
            "reg_no" => "nullable|string|min:7|max:7",
            "expiry_date" => "nullable|date",
            "amount_paid" => "nullable|numeric",
            "expected_amount" => "nullable|numeric",
            "rate" => "nullable|numeric",
            "notes" => "nullable|string",
            "created_by" => "numeric"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $insurancePayment = new ZinaraTransaction();
        $insurancePayment->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
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

        $insurancePayment = ZinaraTransaction::findOrFail($id);
        $insurancePayment->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_zinara_transaction(Request $request, $id = null)
    {
        if ($id == null) {
            $data = ZinaraTransaction::all();
        } else {
            $data = ZinaraTransaction::query()->where("id", $id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
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
