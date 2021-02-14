<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-student', function (User $user) {
            return $user->role == 'STUDENT';
        });

        Gate::define('is-manager', function (User $user) {
            return $user->role == 'MANAGER';
        });

        Gate::define('is-admin', function (User $user) {
            return $user->role == 'ADMIN';
        });

        /*
        Gate::define('is', function($user, $roles){
            foreach ($roles as $role){
                if(Gate::allows('is-'.$role))
                    return true;
            }
            return false;
        });
        */

    }
}
