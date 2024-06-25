<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\DSTVPackage;
use App\Models\DSTVTransaction;
use App\Models\PermanentDisc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermanentDiscController extends Controller
{
    public function view(Request $request){
        $permanent_discs = PermanentDisc::all();

        $data['permanent_discs'] = $permanent_discs;
        return view('permanent.disc.list',$data);
    }
	public function edit_permanent_disc($id)
    {
        // Retrieve the egg from the database
        $permanent_disc = PermanentDisc::findOrFail($id);
		$data['currencies'] = Currency::all();
		$data['permanent_disc'] = $permanent_disc;
        return view('permanent.disc.edit',$data);
    }
	public function view_permanent_disc($id)
	{
		$permanent_disc = PermanentDisc::findOrFail($id);
		$data['currencies'] = Currency::all();
		$data['permanent_disc'] = $permanent_disc;
        return view('permanent.disc.view',$data);
	}

    public function add(Request $request,$id = null){

        if($id != null) {
            $permanent_disc = DSTVTransaction::findOrFail($id);
            $data['permanent_disc'] = $permanent_disc;
        }else{
            $data['permanent_disc'] = new PermanentDisc();
        }

        $data['currencies'] = Currency::all();
        return view('permanent.disc.add',$data);
    }
    public function create_permanent_disc(Request $request)
    {
      
    
        $validator = validator()->make($request->all(), [
            "cash_paid" => ['required','numeric'],
            "quantity_sold" => "required|numeric",
            "quantity_received" => "required|numeric",
            "name" => "nullable|string",
            "currency_id" => "required|numeric",
            "phone" => "nullable|string",
            "order_price" => "nullable|numeric",
            "notes" => "nullable|string",
            "created_by" => "nullable|numeric",
			"transaction_date" => "nullable|date"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
		$data['created_by'] = auth()->user()->id;
        $permanentDisc = new PermanentDisc();
        $permanentDisc->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_permanent_disc(Request $request)
    {
		$id = $request->input('id'); 
        $data = $request->validate([
            "cash_paid" => ['nullable','numeric'],
            "quantity_sold" => "nullable|numeric",
            "quantity_received" => "nullable|numeric",
            "currency_id" => "nullable|numeric",
            "order_price" => "nullable|numeric",
            "notes" => "nullable|string",
			"name" => "string",
			"phone" => "string"
        ]);
		$data['cash_paid']= isset($data['cash_paid']) ? $data['cash_paid'] : 0.00;
		$data['quantity_sold'] = isset($data['quantity_sold']) ? $data['quantity_sold'] : 0;
		$data['quantity_received'] = isset($data['quantity_received']) ? $data['quantity_received'] : 0;
		$data['order_price']=isset($data['order_price']) ? $data['order_price'] : 0.00;

        $permanentDisc = PermanentDisc::findOrFail($id);
        $permanentDisc->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_permanent_disc(Request $request,$id = null){
        if($id == null) {
            $data = PermanentDisc::all();
        }else{
            $data = PermanentDisc::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_permanent_disc(Request $request,$id){
        $permanentDisc = PermanentDisc::findOrFail($id);
        $permanentDisc->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
