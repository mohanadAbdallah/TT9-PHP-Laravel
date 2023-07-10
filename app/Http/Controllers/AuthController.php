<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('/');
    }


    public function login(Request $request)
    {
        $validation = $request->validate([
            'email'=>'required,email',
            'password'=>'required',
        ]);

        $user = User::where('email', $validation['email'])->first();

        if (!$user || !Hash::check($validation['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid user email or password']);
        }

        return redirect('/');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
