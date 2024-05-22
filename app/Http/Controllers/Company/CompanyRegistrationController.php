<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyRegistration;
use App\Models\Company\CompanyRegistrationSupplier;
use App\Models\InsuranceBroker;
use App\Models\Zinara\ZinaraTransaction;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
		$data['currencies'] = Currency::all();
        $data['company_registration_suppliers'] = CompanyRegistrationSupplier::all();
        return view('company.registration.add',$data);
    }

	public function company_registration_edit($id){

		$data['company_registration'] = CompanyRegistration::findOrFail($id);
		$data['currencies'] = Currency::all();
		$data['company_registration_suppliers'] = CompanyRegistrationSupplier::all();
		return view('company.registration.edit',$data);

	}

    public function create_company_registration(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "name" => "nullable|string|min:1",
            "phone" => "nullable|string|min:1",
            "charge" => "required|numeric|min:1",
            "currency_id" => "required|numeric|min:1",
            "amount_paid" => "required|numeric|min:1",
            "notes" => "nullable|string",
            "created_by" => "nullable|numeric",
			"expenses" => "required|numeric",
			"supplier" => "nullable|numeric",
			"commission" => "required|numeric",
			"transaction_date" => "nullable|date",
			"charge" => "nullable|numeric",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $data['created_by'] = auth()->user()->id;
      

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
            "charge" => "required|numeric|min:1",
            "currency_id" => "required|numeric|min:1",
            "amount_paid" => "required|numeric|min:1",
            "notes" => "nullable|string",
            "created_by" => "nullable|numeric",
			"expenses" => "required|numeric",
			"supplier" => "nullable|numeric",
			"commission" => "required|numeric",
			"transaction_date" => "nullable|date",
			"charge" => "nullable|numeric",
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
