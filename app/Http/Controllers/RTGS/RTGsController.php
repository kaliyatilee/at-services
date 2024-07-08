<?php

namespace App\Http\Controllers\RTGS;

use App\Http\Controllers\Controller;
use App\Models\RTGS\RTGs;
use Illuminate\Http\Request;
use function auth;
use function response;
use function view;
use Modules\Messaging\Http\Controllers\DigitalReceiptsMessagingController;

class RTGsController extends Controller
{
    public function view(Request $request)
    {
        $rtgss = RTGs::all();

        $data['rtgss'] = $rtgss;
        return view('rtgs.list', $data);
    }

    public function add(Request $request, $id = null)
    {

        if ($id != null) {
            $rtgs = RTGs::findOrFail($id);
            $data['rtgs'] = $rtgs;
        } else {
            $data['rtgs'] = new RTGs();
        }

        $transaction_types = [
            "1" => "Amount In",
            "2" => "Amount Out",
        ];

        $data['transaction_types'] = $transaction_types;

        return view('rtgs.add', $data);
    }

	public function edit_rtgs($id){
            $rtgs = RTGs::findOrFail($id);
            $data['rtgs'] = $rtgs;

        $transaction_types = [
            "1" => "Amount In",
            "2" => "Amount Out",
        ];

        $data['transaction_types'] = $transaction_types;

        return view('rtgs.edit', $data);

	}

	public function view_rtgs($id)
	{
		$rtgs = RTGs::findOrFail($id);
		$data['rtgs'] = $rtgs;

	$transaction_types = [
		"1" => "Amount In",
		"2" => "Amount Out",
	];

	$data['transaction_types'] = $transaction_types;

	return view('rtgs.view', $data);

	}

    public function create_rtgs(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "transaction_type" => ['nullable', 'numeric'],
            "amount" => "nullable|numeric",
            "description" => "nullable|string",
            "name" => "nullable|string",
            "phone" => "nullable|string",
            "expected_amount" => "nullable|numeric",
            "rate" => "nullable|numeric",
            "notes" => "nullable|string",
            "created_by" => "numeric",
			"transaction_date" => "required|date"
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
		$data['expected_amount']= doubleval(isset($data['expected_amount'])) ? $data['expected_amount'] : 0;
        $rtgs = new RTGs();
        $rtgs->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }


    public function update_rtgs(Request $request, $id)
    {
        $data = $request->validate([
			"transaction_type" => ['required', 'numeric'],
            "amount" => "required|numeric",
            "description" => "nullable|string",
            "name" => "nullable|string",
            "phone" => "nullable|string",
            "expected_amount" => "nullable|numeric",
            "rate" => "nullable|numeric",
            "notes" => "nullable|string",
            "created_by" => "numeric",
			"transaction_date" => "date"
        ]);


        $rtgs = RTGs::findOrFail($id);
        $rtgs->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_rtgs(Request $request, $id = null)
    {
        if ($id == null) {
            $data = RTGs::all();
        } else {
            $data = RTGs::query()->where("id", $id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_rtgs_by_user(Request $request, $user_id = null)
    {
        if ($user_id == null) {
            $data = RTGs::all();
        } else {
            $data = RTGs::query()->where("created_by", $user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_rtgs(Request $request, $id)
    {
        $rtgs = RTGs::findOrFail($id);
        $rtgs->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
