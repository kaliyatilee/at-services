<?php

namespace App\Http\Controllers\Notes;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Ecocash\Ecocash;
use App\Models\Ecocash\EcocashAgentLine;
use App\Models\Ecocash\EcocashTransactionType;
use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function view(Request $request){

        $notes = Notes::all();

        $data['notes'] = $notes;
        return view('notes.list',$data);
    }

    public function add(Request $request,$id = null){

        if($id != null) {
            $notes = Notes::findOrFail($id);
            $data['notes'] = $notes;
        }else{
            $data['notes'] = new Notes();
        }

        return view('notes.add',$data);
    }

    public function create_notes(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "notes" => ["nullable","string"],
            "date" => "nullable|date"]);

// Check if validation fails
        if ($validator->fails()) {
            // Return validation errors as JSON response
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        if(!isset($data['date'])){
            $data['date'] = date('Y-m-d');
        }

        $notes = Notes::query()->where("date",$data['date'])->first();

        if($notes === null){
            $notes = new Notes();
            $notes->create($data);
        }else{
            $notes->update(["notes" => $data['notes']]);
        }

        return response()->json([
            'message' => "Saved successfully",
            'success' => true
        ]);
    }

    public function list_notes(Request $request,$date = null){
        if($date == null) {
            $data = Notes::all();
        }else{
            $data = Notes::query()->where("date",$date)->get();
        }

        return response()->json([
            'data' => $data,
            'message' => "Success",
            'success' => true
        ]);
    }

    public function delete_notes(Request $request,$id){
        $insurancePayment = Notes::findOrFail($id);
        $insurancePayment->delete();

        return response()->json([
            'message' => "Deleted successfully",
            'success' => true
        ]);
    }
}
