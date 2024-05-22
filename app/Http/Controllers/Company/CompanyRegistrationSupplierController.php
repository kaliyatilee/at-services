<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyRegistrationSupplier;
use App\Models\DSTVPackage;
use App\Models\DSTVTransaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyRegistrationSupplierController extends Controller
{
    public function view(Request $request)
    {
        $company_registration_suppliers = CompanyRegistrationSupplier::all();

        $data['company_registration_suppliers'] = $company_registration_suppliers;
        return view('company.registration.supplier.list', $data);
    }

    public function add(Request $request, $id = null)
    {

        if ($id != null) {
            $company_registration_supplier = CompanyRegistrationSupplier::findOrFail($id);
            $data['company_registration_supplier'] = $company_registration_supplier;
        } else {
            $data['company_registration_supplier'] = new CompanyRegistrationSupplier();
        }

        return view('company.registration.supplier.add', $data);
    }

	public function edit_company_registration_supplier($id){
            $company_registration_supplier = CompanyRegistrationSupplier::findOrFail($id);
            $data['company_registration_supplier'] = $company_registration_supplier;

        	return view('company.registration.supplier.edit', $data);
	}

    public function create_company_registration_supplier(Request $request)
    {
        $data = $request->validate([
            "name" => ['nullable', 'string',Rule::unique("company_registration_supplier")],
            "phone1" => "nullable|string|min:5",
            "phone2" => "nullable|string",
            "email" => "nullable|email",
            "location" => "nullable|string",
            "notes" => "nullable|string",
        ]);

        $data['created_by'] = auth()->user()->id;

        $companyRegistrationSupplier = new CompanyRegistrationSupplier();
        $companyRegistrationSupplier->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_company_registration_supplier(Request $request, $id)
    {
        $data = $request->validate([
            "name" => ['nullable', 'string'],
            "phone1" => "nullable|string|min:5",
            "phone2" => "nullable|string",
            "email" => "nullable|email",
            "location" => "nullable|string",
            "notes" => "nullable|string",
        ]);


        $data['created_by'] = auth()->user()->id;

        $companyRegistrationSupplier = CompanyRegistrationSupplier::findOrFail($id);
        $companyRegistrationSupplier->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_company_registration_supplier(Request $request, $id = null)
    {
        if ($id == null) {
            $data = CompanyRegistrationSupplier::all();
        } else {
            $data = CompanyRegistrationSupplier::query()->where("id", $id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function list_company_registration_supplier_by_id(Request $request, $id = null)
    {
        if ($id == null) {
            return response()->json([
                'message' => "Not found",
                'success' => false
            ], 404);
        } else {
            $data = CompanyRegistrationSupplier::query()->where("id", $id)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_company_registration_supplier(Request $request, $id)
    {
        $dstvTransaction = CompanyRegistrationSupplier::findOrFail($id);
        $dstvTransaction->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
