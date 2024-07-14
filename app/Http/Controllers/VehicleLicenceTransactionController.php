<?php

namespace App\Http\Controllers;

use App\Models\VehicleLicenceTransaction;
use App\Http\Requests\StoreVehicleLicenceTransactionRequest;
use App\Http\Requests\UpdateVehicleLicenceTransactionRequest;
use Illuminate\Http\Request;

class VehicleLicenceTransactionController extends Controller
{
    public function index()
    {
        $transactions = VehicleLicenceTransaction::all();
        return response()->json($transactions);
    }

    public function create()
    {
        // This is usually for web-based forms, not needed in APIs
    }

    public function store(StoreVehicleLicenceTransactionRequest $request)
    {
        $transaction = VehicleLicenceTransaction::create($request->validated());
        return response()->json($transaction, 201);
    }

    public function show(VehicleLicenceTransaction $vehicleLicenceTransaction)
    {
        return response()->json($vehicleLicenceTransaction);
    }

    public function edit(VehicleLicenceTransaction $vehicleLicenceTransaction)
    {
        // This is usually for web-based forms, not needed in APIs
    }

    public function update(UpdateVehicleLicenceTransactionRequest $request, VehicleLicenceTransaction $vehicleLicenceTransaction)
    {
        $vehicleLicenceTransaction->update($request->validated());
        return response()->json($vehicleLicenceTransaction);
    }

    public function destroy(VehicleLicenceTransaction $vehicleLicenceTransaction)
    {
        $vehicleLicenceTransaction->delete();
        return response()->json(null, 204);
    }

    public function export()
    {
        return Excel::download(new VehicleLicenceTransactionsExport, 'vehicle_licence_transactions.xlsx');
    }
}
