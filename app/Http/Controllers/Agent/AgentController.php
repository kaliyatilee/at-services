<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller {
	public function view( Request $request ) {
		$agents = Agent::all();

		$data['agents'] = $agents;

		return view(
			'agent.list',
			$data
		);
	}

	public function add( Request $request, $id = null ) {
		if ( $id != null ) {
			$agent = Agent::findOrFail( $id );
			$data['agent'] = $agent;
		} else {
			$data['agent'] = new Agent();
		}

		return view(
			'agent.add',
			$data
		);
	}

	public function agent_edit( $id ) {
		$agent = Agent::findOrFail( $id );
		$data['agent'] = $agent;

		return view(
			'agent.edit',
			$data
		);
	}

	public function agent_view( $id ) {
		$agent = Agent::findOrFail( $id );
		$data['agent'] = $agent;

		return view(
			'agent.view',
			$data
		);
	}

	public function create_agent( Request $request ) {
		$data = $request->validate( [
			"name" => "required|string|min:1",
			"phone" => "nullable|string|min:5",
			"currency" => "string",
			"rate" => "required|numeric|min:1",
			"sales" => "required",
			"payment_type" => "required|string",
			"amount_paid" => "required|numeric",
			"transaction_date" => "required|date",
			"account_balance" => "nullable|numeric",
			"notes" => "nullable|string",
			"description" => "string",

		] );

		$agent = new Agent();
		$agent->create( $data );

		return response()->json( [
			'message' => "Saved successfully",
			'success' => true
		] );
	}

	public function update_agent( Request $request, $id ) {
		$data = $request->validate( [
			"name" => "required|string|min:1",
			"phone" => "nullable|string|min:5",
			"currency" => "required'|string",
			"rate" => "required|numeric|min:1",
			"sales" => " ",
			"payment_type" => "required|string",
			"amount_paid" => "required|numeric",
			"transaction_date" => "required|date",
			"account_balance" => "nullable|numeric",
			"notes" => "nullable|string",
			"description" => "string",
		] );

		$agent = Agent::findOrFail( $id );
		$agent->update( $data );

		return response()->json( [
			'message' => "Updated successfully",
			'success' => true
		] );
	}

	public function list_agents( Request $request, $id = null ) {
		if ( $id == null ) {
			$data = Agent::all();
		} else {
			$data = Agent::query()->where(
				"id",
				$id
			)->first();
		}

		return response()->json( [
			'data' => $data,
			'message' => "Success",
			'success' => true
		] );
	}

	public function delete_agent( Request $request, $id ) {
		$agent = Agent::findOrFail( $id );
		$agent->delete();

		return response()->json( [
			'message' => "Deleted successfully",
			'success' => true
		] );
	}
}
