<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Facades\Abilities;
use App\Facades\AbilitiesFacade;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Product'=>'App\Policies\ProductPolicy'
    ];

    public function register()
    {
        parent::register();
        $this->app->bind('abilities', function () {
            return include base_path('data/abilities.php');
        }); //instance not working 
    }

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // Gate::before(function ($user,$abilities) {
        //     if($user->super_admin){
        //         return true;
        //     }
        // });


        // foreach (Abilities::abilities() as $key => $value) {
        // foreach ($this->app->make('abilities') as $key => $value) {
        //     Gate::define($key, function ($user) use ($key) {
        //         return $user->hasAbility($key);
        //     });
        // }



        //  Gate::define('categories.view', function ($user) {
        //     return true;
        // });
        //  Gate::define('products.view', function ($user) {
        //     return true;
        // });
        //  Gate::define('profile.view', function ($user) {
        //     return true;
        // });
        //  Gate::define('role.view', function ($user) {
        //     return true;
        // });

        // Gate::define('categories.create', function ($user) {
        //     return true;
        // });

        // Gate::define('categories.edit', function ($user) {
        //     return true;
        // });

        // Gate::define('categories.delete', function ($user) {
        //     return true;
        // });


    }
}
