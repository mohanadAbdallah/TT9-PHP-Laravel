<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\request()->is('/admin','/admin/*')){
            Config::set([
                'fortify.guard' => 'admin',
                'fortify.prefix' => 'admin',
                'fortify.passwords' => 'admins',
                'fortify.username' => 'username',
            ]);
        }

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::viewPrefix('auth.');

        Fortify::authenticateUsing(function (Request $request) {

            $user = User::whereUsername($request->username)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
            return Response::json([
                'message' => __('Invalid credentials'),
            ], 401);

        });

//        Fortify::loginView('auth.login');
//        Fortify::loginView('auth.register');
//        Fortify::resetPasswordView('');
//        Fortify::requestPasswordResetLinkView('forgot-password');

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
