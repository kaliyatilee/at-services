<?php

namespace App\Http\Controllers\DSTV;

use App\Http\Controllers\Controller;
use App\Models\DSTVPackage;
use App\Models\DSTVTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use function response;

class DSTVPackageController extends Controller
{
    public function view(Request $request){
        $dstv_packages = DSTVPackage::all();

        $data['dstv_packages'] = $dstv_packages;
        return view('dstv.package.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $dstv_package = DSTVPackage::findOrFail($id);
            $data['dstv_package'] = $dstv_package;
        }else{
            $data['dstv_package'] = new DSTVPackage();
        }

        return view('dstv.package.add',$data);
    }
	public function dstv_package_edit($id){
            $dstv_package = DSTVPackage::findOrFail($id);
            $data['dstv_package'] = $dstv_package;

        return view('dstv.package.edit',$data);

	}

    public function create_dstv_package(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => ['required','string','min:2',Rule::unique("dstv_packages")],
            "amount_rand" => "required|numeric|min:1",
            "commission_usd" => "required|numeric|min:1",
        ]);

	
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }


        $data = $validator->validated();
        $data['created_by'] = auth()->user()->id;

        $dstvPackage = new DSTVPackage();
        $dstvPackage->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_dstv_package(Request $request,$id)
    {
        $validator = validator()->make($request->all(), [
            "name" => ['required','string','min:2'],
            "amount_rand" => "required|numeric|min:1",
            "commission_usd" => "required|numeric|min:1",
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $dstvPackage = DSTVPackage::findOrFail($id);
        $dstvPackage->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_dstv_package(Request $request,$id = null){
        if($id == null) {
            $data = DSTVPackage::all();
        }else{
            $data = DSTVPackage::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete(Request $request,$id){
        $dstvPackage = DSTVPackage::findOrFail($id);
        $dstvPackage->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
