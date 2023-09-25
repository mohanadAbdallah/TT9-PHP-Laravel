<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\AuthTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Pipeline;


class AuthController extends Controller
{
    use AuthTrait;
    public function register(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        User::create($request->validated());
        return redirect()->route('/');
    }

    public function users(Request $request)
    {
        $pipelines = [
            \App\Filters\ByEmail::class
        ];

        return Pipeline::send(User::query())
            ->through($pipelines)
            ->thenReturn()
            ->paginate();
    }

    public function login(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $validation = $request->validate([
            'email' => 'required,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validation['email'])->first();

        if (!$user || !Hash::check($validation['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid user email or password']);
        }

        return redirect('/');
    }

    public function logout(): RedirectResponse
    {
        Auth::guard($this->checkGuard(request()))->logout();

        return redirect($this->redirect(request()));
    }
}
