<?php

namespace App\Http\Controllers;

use Illuminate\Testing\Fluent\Concerns\Has;
use Str;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'phone1' => 'required',
            'password' => 'required',
            'is_mobile' => 'nullable',
        ]);

        $user = User::query()->where("phone1", $attributes['phone1'])->first();
        if ($user == null) {
            if (isset($attributes['is_mobile'])) {
                return response()->json([
                    'message' => "Your provided credentials could not be verified.",
                    'success' => false
                ],500);
            } else {
                throw ValidationException::withMessages([
                    'phone1' => 'Your provided credentials could not be verified.'
                ]);
            }
        }

        if (!\Illuminate\Support\Facades\Hash::check($attributes['password'], $user->password)) {
            if (isset($attributes['is_mobile'])) {
                return response()->json([
                    'message' => "Your provided credentials could not be verified.",
                    'success' => false
                ],500);
            } else {
                throw ValidationException::withMessages([
                    'password' => 'Your provided credentials could not be verified.'
                ]);
            }
        }

        if(!isset($attributes['is_mobile']) && $user->is_admin == 0){
            throw ValidationException::withMessages([
                'password' => 'You not authorised'
            ]);
        }

        auth()->login($user);

        session()->regenerate();

        if(isset($attributes['is_mobile'])){
            return response()->json([
                'data' => $user,
                'message' => "Logged In Successfully",
                'success' => true
            ]);
        }else {
            return redirect('/dashboard');
        }

    }

    public function show()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);

    }

    public function update()
    {

        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
