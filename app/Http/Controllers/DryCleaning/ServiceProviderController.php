<?php

namespace App\Http\Controllers\DryCleaning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DryCleaning\ServiceProviders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;


class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $serviceProviders = ServiceProviders::all();
            return view('dry-cleaning.providers.index', compact('serviceProviders'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while retrieving service providers.');
        }
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'provider'   => 'required',
                'description'       => 'nullable',
                'phone' => 'required',
                'address'   => 'required',
            ], [
                'provider.required'  => 'The provider name is required.',
                'phone.required'  => 'The provider phone is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {

                $provider = ServiceProviders::create([
                    'provider'   =>  $request->provider,
                    'description'       =>  $request->description,
                    'phone' =>  $request->phone,
                    'address'   =>  $request->address,
                ]);

                DB::commit();
                return back()->with('success', 'New provider recored created.');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return back()->with('error', 'Something went wrong. Please try again later.');
            }
        } catch (\Exception $e) {
            return redirect()->back();
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function edit($id)
    {
        try {
            $provider = ServiceProviders::find($id);

            if (!$provider) {
                return redirect()->back();
            }

            return view('dry-cleaning.providers.edit', compact('provider'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit provider page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $provider = ServiceProviders::find($id);

            if (!$provider) {
                return redirect()->back();
            }

            $validator = validator()->make($request->all(), [
                'provider'   => 'required',
                'description'       => 'nullable',
                'phone' => 'required',
                'address'   => 'required',
            ], [
                'provider.required'  => 'The provider name is required.',
                'phone.required'  => 'The provider phone is required.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            try {

                $provider->update([
                    'provider'   =>  $request->provider,
                    'description'       =>  $request->description,
                    'phone' =>  $request->phone,
                    'address'   =>  $request->address,
                ]);

                DB::commit();

                return back()->with('success', 'Provider record updated.');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
                return back()->with('error', 'Something went wrong. Please try again later.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }    

    public function delete($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $record = ServiceProviders::find($id);

                // Check if the resource exists
                if (!$record) {
                    return back()->with('error', 'Something went wrong. Please try again later.');
                }

                $record->delete();
            });

            return back()->with('success', 'Record deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }
    
}
