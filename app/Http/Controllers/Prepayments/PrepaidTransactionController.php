<?php

namespace App\Http\Controllers\Prepayments;


use App\Http\Requests\PrepaidTransactionRequest;
use App\Models\PrepaidTransaction;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class PrepaidTransactionController extends Controller
{
    public function index(){
        $prepaidTransactions = PrepaidTransaction::all();
        $prepaidTransactions = $prepaidTransactions;
        return view('prepayments.list')->with(compact('prepaidTransactions'));
    }

    public function create(){
        $currencies=Currency::all();
        return view('prepayments.create')->with(compact('currencies'));
    }

    public function store(PrepaidTransactionRequest $request){
        $validated = $request->validated();
        $validated['created_by'] = Auth::user()->id;
        PrepaidTransaction::create($request->validated());
        return redirect()->route('prepaid.transaction.index')->with(['status'=>'success','message'=>'Transaction Successfully Saved']);
    }

	public function edit($id){
        $prepaidTransaction = PrepaidTransaction::findOrFail($id);
        $currencies=Currency::all();
        return view('prepayments.edit')->with(compact('prepaidTransaction','currencies'));
	}
    public function update(Request $request,$id)
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
