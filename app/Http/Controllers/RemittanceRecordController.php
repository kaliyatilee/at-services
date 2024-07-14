<?php

namespace App\Http\Controllers;

use App\Models\RemittanceRecord;
use App\Http\Requests\StoreRemittanceRecordRequest;
use App\Http\Requests\UpdateRemittanceRecordRequest;
use Illuminate\Http\Request;

class RemittanceRecordController extends Controller
{
    public function index()
    {
        $records = RemittanceRecord::all();
        return response()->json($records);
    }

    public function create()
    {
        // This is usually for web-based forms, not needed in APIs
    }

    public function store(StoreRemittanceRecordRequest $request)
    {
        $record = RemittanceRecord::create($request->validated());
        return response()->json($record, 201);
    }

    public function show(RemittanceRecord $remittanceRecord)
    {
        return response()->json($remittanceRecord);
    }

    public function edit(RemittanceRecord $remittanceRecord)
    {
        // This is usually for web-based forms, not needed in APIs
    }

    public function update(UpdateRemittanceRecordRequest $request, RemittanceRecord $remittanceRecord)
    {
        $remittanceRecord->update($request->validated());
        return response()->json($remittanceRecord);
    }

    public function destroy(RemittanceRecord $remittanceRecord)
    {
        $remittanceRecord->delete();
        return response()->json(null, 204);
    }

    public function export()
    {
        return Excel::download(new RemittanceRecordsExport, 'remittance_records.xlsx');
    }
}
