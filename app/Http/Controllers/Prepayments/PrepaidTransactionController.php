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
    public function update(PrepaidTransactionRequest $request, $id){
        $prepaidTransaction= PrepaidTransaction::findorfail($id);
        $prepaidTransaction->update($request->validated());
        return redirect()->route('prepaid.transaction.index')->with(['status'=>'success','message'=>'Transaction Successfully Updated']);
    }
    public function destroy(Request $request,$id){
        $prepaidTransaction= PrepaidTransaction::findorfail($id);
        $prepaidTransaction->delete();
        return redirect()->route('prepaid.transaction.index')->with(['status'=>'success','message'=>'Transaction Successfully Updated']);
    }
}
