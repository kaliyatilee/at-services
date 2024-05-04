<?php

namespace App\Http\Controllers\DSTV;

use App\Http\Controllers\Controller;
use App\Models\DSTVPayment;
use App\Models\DSTVTransaction;
use Illuminate\Http\Request;
use function response;

class DSTVPaymentController extends Controller
{
    public function create_dstv_payment(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "currency" => ['required', 'string'],
            "amount" => "required|numeric|min:1",
            "dstv_transaction_id" => "required|numeric|min:1",
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

        $data['created_by'] = auth()->user()->id;

        $dstvTransaction = DSTVTransaction::findOrFail($data['dstv_transaction_id']);

        $data['amount_before'] = $dstvTransaction->balance;
        $data['amount_after'] = $dstvTransaction->balance - $data['amount'];

        $dstvTransaction->update([
            "balance" => $data['amount_after']
        ]);

        $dstvPayment = new DSTVPayment();
        $dstvPayment->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function list_dstv_payments(Request $request, $dstv_transaction_id = null)
    {
        if ($dstv_transaction_id == null) {
            return response()->json([
                'message' => "DSTV Transaction can't be null",
                'success' => false
            ], 500);
        } else {
            $data = DSTVPayment::query()->where("dstv_transaction_id", $dstv_transaction_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_dstv_payment(Request $request, $id)
    {
        $dstvPayment = DSTVPayment::findOrFail($id);
        $dstvPayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
