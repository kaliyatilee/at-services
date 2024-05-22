<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
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
}
