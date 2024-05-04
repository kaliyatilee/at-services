<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store(){

       // die(json_encode(request()->all()));
        $attributes = request()->validate([
            'name' => 'required|max:255',
            'phone1' => 'required|max:20',
            'phone2' => 'max:20',
            'password' => 'required|min:5|max:255',
        ]);

        $user = User::create($attributes);
        auth()->login($user);

        return redirect('/dashboard');
    }
}
