<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = tap(/**
         * @throws \Exception
         */ Auth::getProvider()->retrieveByCredentials($credentials), function ($user) use($credentials){
            $validated = !is_null($user) && Auth::getProvider()->validateCredentials($user, $credentials);
            if (!$validated) {
                throw new \Exception('invalid');
            }

            return $user;

        });
        return response()->json(['data' => $user], 200);


    }
//        $user = User::where('email', $request->input('email'))->first();
//
//        if ($user) {
//            $user->save();
//
//            if (Hash::check($request->input('password'), $user->password)) {
//                $token = $user->createToken('Registration token')->plainTextToken;
//                return response()->json(['data' => $user, 'token' => $token, 'status' => true, 'message' => 'success'], 200);
//            }
//        }
//        return response()->json(['message' => 'invalid username or password', 'status' => false], 422);


    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        if ($user) {
            $token = $user->createToken('Registration token')->plainTextToken;
            return response()->json(['data' => $user, 'token' => $token, 'status' => true, 'message' => 'success'], 200);
        }
        return response()->json(['message' => 'invalid username or password', 'status' => false], 422);

    }
}
