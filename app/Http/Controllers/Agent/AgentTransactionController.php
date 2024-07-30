<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent\Agent;
use App\Models\Agent\AgentTransaction;
use Illuminate\Http\Request;

class AgentTransactionController extends Controller {
	public function view() {
		$agent_transaction = AgentTransaction::all();

		$data['agent_transactions'] = $agent_transaction;
		return view('agent.transaction.list',$data);
	}

	public function add( Request $request, $id = null ) {
		if ( $id != null ) {
			$agent_transaction = AgentTransaction::findOrFail( $id );
			$data['agent_transaction'] = $agent_transaction;
		} else {
			$data['agent_transaction'] = new AgentTransaction();

			return view('agent.transaction.add',$data);
		}
	}

	public function agent_transaction_edit( $id ) {
		$agent_transaction = AgentTransaction::findOrFail( $id );
		$data['transaction'] = $agent_transaction;

		return view('agent.transaction.edit',$data);
	}

	public function create_agent_transaction( Request $request ) {
		$data = $request->validate( [
			'name' => 'required',
			'amount_remmited' => 'required|numeric',
			'account_balance' => 'required|numeric',
		] );
		$data['created_by'] = auth()->user()->id;
		$transaction = AgentTransaction::create( $data );

		return response()->json( [
			'data' => $transaction,
			'message' => 'Transaction created successfully',
			'success' => true
		],
			201 );
	}

	public function show($id) {
		$transaction = AgentTransaction::findOrFail($id);
		$agent = $transaction->agent;

		if (!$agent) {
			return redirect()->back()->with('error', 'Agent not found');
		}

		// Calculate account balance
		$totalAmountPaid = $agent->transactions->sum('amount_paid');
		$totalAmountRemitted = $agent->transactions->sum('amount_remmitted');
		$accountBalance = $totalAmountPaid - $totalAmountRemitted;

		$transactions = $agent->transactions;

		return view('agent.transaction.view', compact('agent', 'totalAmountRemitted','totalAmountPaid', 'transactions', 'accountBalance'));
	}



	public function edit( $id ) {
		$transaction = AgentTransaction::findOrFail( $id );

		return view('agent.transaction.edit',compact( 'transaction' ));
	}

	public function update_agent_transaction( Request $request, $id ) {
		$validatedData = $request->validate( [
			'name' => 'required',
			'amount_remmited' => 'required|numeric',
			'account_balance' => 'required|numeric',
		] );

		$validatedData['created_by'] = auth()->user()->id;

		$agent_transaction = AgentTransaction::findOrFail( $id );
		$agent_transaction->update( $validatedData );

		return response()->json( [
			'message' => "Updated successfully",
			'success' => true
		] );
	}

	public function list_agent_transactions( Request $request, $id = null ) {
		if ( $id == null ) {
			$data = AgentTransaction::all();
		} else {
			$data = AgentTransaction::query()->where("id",$id	)->first();
		}

		return response()->json( [
			'data' => $data,
			'message' => "Success",
			'success' => true
		] );
	}

	public function delete( $id ) {
		$transaction = AgentTransaction::findOrFail( $id );
		$transaction->delete();

		return response()->json( [
			'message' => "Deleted successfully",
			'success' => true
		] );
	}
}
