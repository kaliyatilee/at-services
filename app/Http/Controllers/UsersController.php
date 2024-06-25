<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function view(Request $request){

        $users = User::all();

        $data['users'] = $users;
        return view('user.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $user = User::findOrFail($id);
            $data['user'] = $user;
        }else{
            $data['user'] = new User();
        }

        return view('user.add',$data);
    }
	public function user_edit($id){
        $user = User::findOrFail($id);
        $data['user'] = $user;
        return view('user.edit',$data);
	}

	public function user_view($id){
		$user = User::findOrFail($id);
		$data['user'] = $user;
	return view('user.view',$data);

}
    public function create_user(Request $request)
    {

        $validator = validator()->make($request->all(), [
            "phone1" => ['required','numeric','min:5'],
            "name" => "required|string|min:1",
            "phone2" => "nullable|string|min:5",
            "password" => "required|string|min:5",
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

        $data['password'] = Hash::make($data['password']);

        $user = new User();
        $user->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_user(Request $request,$id)
    {
        $data = $request->validate([
            "phone1" => ['required','numeric','min:5'],
            "name" => "required|string|min:1",
            "phone2" => "string|min:5"
        ]);

        $user = User::findOrFail($id);
        $user->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function update_user_password(Request $request,$id)
    {
        $data = $request->validate([
            "old_password" => "required|string|min:5",
            "new_password" => "required|string|min:5"
        ]);


        $user = User::findOrFail($id);

        if(!Hash::check($data['old_password'],$user->password)){
            return response()->json([
                'message' => "Invalid password",
                'success' => false
            ],500);
        }

        $dataFinal['password'] = Hash::make($data['new_password']);
        $user->update($dataFinal);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_users(Request $request,$id = null){
        if($id == null) {
            $data = User::all();
        }else{
            $data = User::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_user(Request $request,$id){
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
