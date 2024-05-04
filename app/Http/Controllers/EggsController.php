<?php

namespace App\Http\Controllers;

use App\Models\Ecocash\EcocashTransactionType;
use App\Models\Egg;
use App\Models\InsuranceBroker;
use Illuminate\Http\Request;

class EggsController extends Controller
{
    public function view(Request $request){

        $eggs = Egg::all();

        $data['eggs'] = $eggs;
        return view('eggs.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $egg = Egg::findOrFail($id);
            $data['egg'] = $egg;
        }else{
            $data['egg'] = new Egg();
        }

        return view('eggs.add',$data);
    }

    public function create_eggs(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "cash_paid" => "nullable|numeric|min:1",
            "quantity_received" => "nullable|numeric",
            "quantity_sold" => "nullable|numeric",
            "currency" => "nullable|numeric",
            "breakages" => "nullable|numeric",
            "order_price" => "nullable|numeric",
            "notes" => "nullable|string",
            "created_by" => "nullable|numeric"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $egg = new Egg();
        $egg->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_eggs(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "cash_paid" => "nullable|numeric|min:1",
            "quantity_received" => "nullable|numeric",
            "quantity_sold" => "nullable|numeric",
            "breakages" => "nullable|numeric",
            "order_price" => "nullable|numeric",
            "notes" => "nullable|string",
        ]);

        $egg = Egg::findOrFail($id);
        $egg->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_eggs(Request $request)
    {
        $data = Egg::all();

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_eggs(Request $request, $id)
    {
        $egg = Egg::findOrFail($id);
        $egg->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
