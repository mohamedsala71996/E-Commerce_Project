<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Config;
use Laravel\Fortify\Contracts\LoginResponse;



class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();
        if ($request->is('admin/*')) {
            config::set('fortify.guard', 'admin');
            config::set('fortify.passwords', 'admins');
            config::set('fortify.prefix', 'admin');
            // config::set('fortify.home', '/dashboard');
        }

        $this->app->instance(LoginResponse::class, new class implements LoginResponse
        {
            public function toResponse($request)
            {
                if ($request->user('web')) {
                    return redirect()->intended('/');
                }
                return redirect()->intended('/dashboard');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Fortify::viewPrefix('auth.'); //return all view pages if i use the standard name of pages
        // Fortify::loginView('auth.login');
        // Fortify::registerView('auth.register');
        // Fortify::resetPasswordView('auth.reset-password');

        //----------------------------------------------------------------
        //  Fortify::loginView(function(){
        //     if ( config::get('fortify.guard')=='admin') {
        //         return view('auth.login');
        //     }
        //     return view('front.auth.login');
        //  });
        //-------------------------------------------------------

        // if (config('fortify.guard')=='web') {

        //     Fortify::viewPrefix('front.auth.');
        // }else{

        //     Fortify::viewPrefix('auth.');

        // }
        if (config::get('fortify.guard') == 'web') {

            Fortify::viewPrefix('front.auth.');
        } else {
            Fortify::authenticateUsing( [new AuthenticateUser,'authenticate']);
            Fortify::viewPrefix('auth.');
        }
    }
}
