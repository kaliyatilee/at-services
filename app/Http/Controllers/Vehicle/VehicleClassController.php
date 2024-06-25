<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\InsurancePayment;
use App\Models\InsuranceTransaction;
use App\Models\VehicleClass;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleClassController extends Controller
{
    public function view(Request $request){

        $vehicle_classes = VehicleClass::all();

        $data['vehicle_classes'] = $vehicle_classes;
        return view('vehicle.class.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $vehicle_class = VehicleClass::findOrFail($id);
            $data['vehicle_class'] = $vehicle_class;
        }else{
            $data['vehicle_class'] = new VehicleClass();
        }

        $data['currencies'] = Currency::all();

        return view('vehicle.class.add',$data);
    }

	public function vehicle_class_edit($id){
        $vehicle_class = VehicleClass::findOrFail($id);
		$data['vehicle_class'] = $vehicle_class;
        $data['currencies'] = Currency::all();

        return view('vehicle.class.edit',$data);

	}

	public function vehicle_class_view($id)
	{
		$vehicle_class = VehicleClass::findOrFail($id);
		$data['vehicle_class'] = $vehicle_class;
        $data['currencies'] = Currency::all();

        return view('vehicle.class.view',$data);
	}

    public function create_vehicle_class(Request $request)
    {
        $data = $request->validate([
            "name" => ['required','string',Rule::unique("vehicle_class")],
            "currency_id" => "required|numeric|min:1",
            "amount" => "required|numeric|min:1"
        ]);

        $vehicleClass = new VehicleClass();
        $vehicleClass->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_vehicle_class(Request $request,$id)
    {
        $data = $request->validate([
            "name" => ['required','string'],
            "currency_id" => "required|numeric|min:1",
            "amount" => "required|numeric|min:1"
        ]);

        $vehicleClass = VehicleClass::findOrFail($id);
        $vehicleClass->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => false
        ]);
    }

    public function list_vehicle_class(Request $request,$id = null){
        if($id == null) {
            $data = VehicleClass::all();
        }else{
            $data = VehicleClass::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_vehicle_class(Request $request,$id){
        $vehicleClass = VehicleClass::findOrFail($id);
        $vehicleClass->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
