<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyRegistration;
use App\Models\Company\CompanyRegistrationSupplier;
use App\Models\InsuranceBroker;
use App\Models\Zinara\ZinaraTransaction;
use Illuminate\Http\Request;

class CompanyRegistrationController extends Controller
{
    //

    public function view(Request $request){

        $company_registrations = CompanyRegistration::all();

        $data['company_registrations'] = $company_registrations;
        return view('company.registration.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $company_registration = CompanyRegistration::findOrFail($id);
            $data['company_registration'] = $company_registration;
        }else{
            $data['company_registration'] = new CompanyRegistration();
        }

        $data['company_registration_suppliers'] = CompanyRegistrationSupplier::all();
        return view('company.registration.add',$data);
    }

    public function create_company_registration(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "charge" => "nullable|numeric|min:1",
            "currency_id" => "nullable|numeric|min:1",
            "amount_paid" => "nullable|numeric|min:1",
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

        $data['expenses'] = 0;
        $data['supplier'] = 0;
        $data['commission'] = 0;

        $companyRegistration = new CompanyRegistration();
        $companyRegistration->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_company_registration(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "charge" => "nullable|numeric|min:1",
            "currency_id" => "nullable|numeric|min:1",
            "amount_paid" => "nullable|numeric|min:1",
            "notes" => "nullable|string",
        ]);

        $companyRegistration = CompanyRegistration::findOrFail($id);
        $companyRegistration->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_company_registration(Request $request)
    {
        $data = CompanyRegistration::all();

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_company_registration_by_user(Request $request, $user_id = null)
    {
        if ($user_id == null) {
            $data = CompanyRegistration::all();
        } else {
            $data = CompanyRegistration::query()->where("created_by", $user_id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_company_registration(Request $request, $id)
    {
        $companyRegistration = CompanyRegistration::findOrFail($id);
        $companyRegistration->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
