<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

trait AuthTrait
{
    public function checkGuard(Request $request): string
    {
        if ($request->type == 'student') {
            $guardName = 'student';
        } elseif ($request->type == 'parent') {
            $guardName = 'parent';
        } elseif ($request->type == 'teacher') {
            $guardName = 'teacher';
        } else {
            $guardName = 'web';
        }
        return $guardName;
    }

    public function redirect(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->type == 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }

        return redirect()->intended(RouteServiceProvider::USER);

    }
}
