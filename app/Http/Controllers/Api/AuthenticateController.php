<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\AuthTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthenticateController extends Controller
{
    use AuthTrait;

    // Eng Abdulhadi Method of login and create Access Token
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = tap(/**
         * @throws \Exception
         */ Auth::getProvider()->retrieveByCredentials($credentials), function ($user) use ($credentials) {
            $validated = !is_null($user) && Auth::getProvider()->validateCredentials($user, $credentials);
            if (!$validated) {
                throw new \Exception('invalid');
            }

            return $user;

        });
        return response()->json(['data' => $user], 200);


    }

    // Laravel Method of login
    public function LaravelLogin(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['sometimes', 'required'],
            'abilities' => ['array']
        ]);

        if (Auth::guard($this->checkGuard($request))->attempt($credentials)) {

            $name = $request->post('device_name', $request->userAgent());
            $abilities = $request->post('abilities', ['*']);

            $token = Auth()->user()->createToken($name, $abilities, now()->addDays(90));
            return Response::json([
                'token' => $token->plainTextToken,
                'user' => Auth()->user(),
            ]);

        }

        return Response::json([
            'message' => __('Invalid credentials'),
        ], 401);

    }

    // Eng Mohammed Safadi Method of login and create Access Token
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['sometimes', 'required'],
            'abilities' => ['array']
        ]);
        $user = User::whereEmail($request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $name = $request->post('device_name', $request->userAgent());
            $abilities = $request->post('abilities', ['*']);
            $token = $user->createToken($name, $abilities, now()->addDays(90));

            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        }
        return Response::json([
            'message' => __('Invalid credentials'),
        ], 401);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        if ($user) {
            $token = $user->createToken('Registration token')->plainTextToken;
            return response()->json(['data' => $user, 'token' => $token, 'status' => true, 'message' => 'success'], 200);
        }
        return response()->json(['message' => 'invalid username or password', 'status' => false], 422);

    }
}
