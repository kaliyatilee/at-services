<?php

namespace App\Http\Controllers\Ecocash;

use App\Http\Controllers\Controller;
use App\Models\Ecocash\EcocashAgentLine;
use App\Models\Ecocash\EcocashTransactionType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EcocashAgentLineController extends Controller
{
    public function view(Request $request){

        $ecocash_agent_lines = EcocashAgentLine::all();

        $data['ecocash_agent_lines'] = $ecocash_agent_lines;
        return view('ecocash.agent_line.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $ecocash_agent_line = EcocashAgentLine::findOrFail($id);
            $data['ecocash_agent_line'] = $ecocash_agent_line;
        }else{
            $data['ecocash_agent_line'] = new EcocashAgentLine();
        }

        return view('ecocash.agent_line.add',$data);
    }

	public function ecocash_line_edit($id){
		$ecocash_agent_line = EcocashAgentLine::findOrFail($id);
		$data['ecocash_agent_line'] = $ecocash_agent_line;
	
		return view('ecocash.agent_line.edit',$data);

	}

	public function ecocash_line_view($id)
	{
		$ecocash_agent_line = EcocashAgentLine::findOrFail($id);
		$data['ecocash_agent_line'] = $ecocash_agent_line;
	
		return view('ecocash.agent_line.view',$data);
	}

    public function create_ecocash_agent_line(Request $request)
    {
        $data = $request->validate([
            "name" => ["required","string",Rule::unique("ecocash_agent_line")],
            "phone" => ["required","string",Rule::unique("ecocash_agent_line")],
            "notes" => "nullable|string",
        ]);

        $data['created_by'] = auth()->user()->id;

        $ecocashAgentLine = new EcocashAgentLine();
        $ecocashAgentLine->create($data);

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function update_ecocash_agent_line(Request $request,$id)
    {
        $data = $request->validate([
            "name" => ["required","string"],
            "phone" => ["required","string"],
            "notes" => "nullable|string",
        ]);

        $ecocashAgentLine = EcocashAgentLine::findOrFail($id);
        $ecocashAgentLine->update($data);

        return response()->json([
            'message' => "Updated successfully",
            'success' => true
        ]);
    }

    public function list_ecocash_agent_line(Request $request,$id = null){
        if($id == null) {
            $data = EcocashAgentLine::all();
        }else{
            $data = EcocashAgentLine::query()->where("id",$id)->first();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_ecocash_agent_line(Request $request,$id){
        $ecocashAgentLine = EcocashAgentLine::findOrFail($id);
        $ecocashAgentLine->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
