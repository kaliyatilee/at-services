<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\CreditAuthorizedClients;
use App\Models\DSTVPackage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
	// CREATE TABLE `clients` (
	// 	`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	// 	`id_number` varchar(20) NOT NULL,
	// 	`name` varchar(50) NOT NULL,
	// 	`phone1` varchar(20) NOT NULL,
	// 	`phone2` varchar(20) DEFAULT NULL,
	// 	`credit_allowed` int(11) NOT NULL DEFAULT 0 COMMENT '0 is false, 1 is true',
	// 	`created_by` int(11) NOT NULL,
	// 	`created_at` timestamp NULL DEFAULT NULL,
	// 	`updated_at` timestamp NULL DEFAULT NULL,
	// 	PRIMARY KEY (`id`)
	//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    public function view(Request $request){

        $clients = Client::all();

        $data['clients'] = $clients;
        return view('client.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $client = Client::findOrFail($id);
            $data['client'] = $client;
        }else{
            $data['client'] = new Client();
        }

        return view('client.add',$data);
    }

	public function client_edit($id){
		    $client = Client::findOrFail($id);
            $data['client'] = $client;
        return view('client.edit',$data);

	}

	public function client_view($id){
		$client = Client::findOrFail($id);
            $data['client'] = $client;
        return view('client.view',$data);
	}

    public function create_client(Request $request)
    {
        $data = $request->validate([
            "id_number" => ['required','string','min:5',Rule::unique("clients")],
            "name" => "required|string|min:1",
            "phone1" => "required|numeric|min:5",
            "phone2" => "nullable|numeric|min:5",
        ]);

        $data['created_by'] = Auth::user()->id;

        $client = new Client();
        $client->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_client(Request $request, $id){
        $data = $request->validate([
            "id_number" => ['required', 'string', 'min:5'],
            "name" => "required|string|min:1",
            "phone1" => "required|string|min:5",
            "phone2" => "required|numeric|min:5",
        ]);

        $client = Client::findOrFail($id);
        $client->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }


    public function list_clients(Request $request,$id = null){
        if($id == null) {
            $data = Client::all();
        }else{
            $data = Client::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_client(Request $request,$id){
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }

    //Ajax
    public function searchClient(Request $request,$search){

        if($search == null || strlen($search) < 2){
            return response()->json([
                'message' => "Search must be greater than 2 characters",
                'success' => false
            ],500);
        }
        $results = Client::where('id_number', 'like', '%' . $search . '%')
            ->orWhere('name', 'like', '%' . $search . '%')
            ->orWhere('phone1', 'like', '%' . $search . '%')
            ->orWhere('phone2', 'like', '%' . $search . '%')
            ->get();

        $data = [];
        foreach ($results as $result){
            $data[] = $result->toJson();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    // credit authorized clients
    // view
    public function create_credit_authorized_client_listview(Request $request){

        $clients = CreditAuthorizedClients::all();

        $data['clients'] = $clients;
        return view('client.list_credit_authorized',$data);
    }


    public function create_credit_authorized_client_view(Request $request)
    {
        return view('client.credit_authorized');
    }
    // create
    public function create_credit_authorized_client(Request $request)
    {
        $request->validate([
            "id_number"          => ['required','string','min:5',Rule::unique("clients")],
            "name"               => "required|string|min:1",
            "phone1"             => "required|numeric|min:5",
            "phone2"             => "nullable|numeric|min:5",
            "address"            => "required|string|min:5",
            "collateral"         => "required|string|min:3",
            "guarantor_name"     => "required|string|min:3",
            "guarantor_phone1"   => "required|numeric|min:5",
            "guarantor_phone2"   => "nullable|numeric|min:5",
            "guarantor_address"  => "required|string|max:60",
            "national_id"        => "required|mimes:pdf,jpg,jpeg,png|max:2048",
            "proof_of_residence" => "required|mimes:pdf,jpg,jpeg,png|max:2048",
            "notes"              => "required|string|max:180",
        ]);

        $national_id = $request->file('national_id')->store('uploads', 'uploads');
        $proof_of_residence = $request->file('proof_of_residence')->store('uploads', 'uploads');

        CreditAuthorizedClients::create([
            "id_number"          => $request->input("id_number"),
            "name"               => $request->input("name"),
            "phone1"             => $request->input("phone1"),
            "phone2"             => $request->input("phone2"),
            "address"            => $request->input("address"),
            "collateral"         => $request->input("collateral"),
            "guarantor_name"     => $request->input("guarantor_name"),
            "guarantor_phone1"   => $request->input("guarantor_phone1"),
            "guarantor_phone2"   => $request->input("guarantor_phone2"),
            "guarantor_address"  => $request->input("guarantor_address"),
            "national_id"        => $national_id,
            "proof_of_residence" => $proof_of_residence,
            "notes"              => $request->input("notes"),

        ]);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }
    // show
    public function credit_authorized_client_view($id_number){
		    $client = CreditAuthorizedClients::where('id_number', $id_number)->first();
            $data['client'] = $client;
        return view('client.show_credit_authorized',$data);
	}

    // update
    public function credit_authorized_client_edit($id){
            $client = CreditAuthorizedClients::where('id_number', $id)->first();
            $data['client'] = $client;
        return view('client.update_credit_authorized',$data);

    }

    public function update_credit_authorized_client(Request $request, $id_number){
        $request->validate([
            "id_number"          => ['required','string','min:5',Rule::unique("clients")],
            "name"               => "required|string|min:1",
            "phone1"             => "required|numeric|min:5",
            "phone2"             => "nullable|numeric|min:5",
            "address"            => "required|string|min:5",
            "collateral"         => "required|string|min:3",
            "guarantor_name"     => "required|string|min:3",
            "guarantor_phone1"   => "required|numeric|min:5",
            "guarantor_phone2"   => "nullable|numeric|min:5",
            "guarantor_address"  => "required|string|max:60",
            "national_id"        => "required|mimes:pdf,jpg,jpeg,png|max:2048",
            "proof_of_residence" => "required|mimes:pdf,jpg,jpeg,png|max:2048",
            "notes"              => "required|string|max:180",
        ]);

        $creditAuthorizedClient = CreditAuthorizedClients::where('id_number', $id_number)->first();

        if ($creditAuthorizedClient) {
            $creditAuthorizedClient->update([
                "id_number"          => $request->input("id_number"),
                "name"               => $request->input("name"),
                "phone1"             => $request->input("phone1"),
                "phone2"             => $request->input("phone2"),
                "address"            => $request->input("address"),
                "collateral"         => $request->input("collateral"),
                "guarantor_name"     => $request->input("guarantor_name"),
                "guarantor_phone1"   => $request->input("guarantor_phone1"),
                "guarantor_phone2"   => $request->input("guarantor_phone2"),
                "guarantor_address"  => $request->input("guarantor_address"),
                "national_id"        => $request->file('national_id')->store('uploads', 'uploads'),
                "proof_of_residence" => $request->file('proof_of_residence')->store('uploads', 'uploads'),
                "notes"              => $request->input("notes"),
            ], ['id_number' => $id_number]);

            return response()->json([
                'message' => "Updated successfully",
                'success' => true
            ]);
        } else {
            return response()->json([
                'message' => "Record not found",
                'success' => false
            ]);
        }
    }
    // end of update
    // delete
    public function delete_credit_authorized_client(Request $request,$id_number){
        $client = CreditAuthorizedClients::where('id_number', $id_number)->first();
        $client->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
