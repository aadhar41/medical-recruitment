<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        /* define a Admin user role */
        Gate::define('isAdmin', function ($user) {
            return $user->role == '1';
        });

        /* define a Jobseeker role */
        Gate::define('isJobseeker', function ($user) {
            return $user->role == '2';
        });

        /* define a Medical Center role */
        Gate::define('isMedicalCenter', function ($user) {
            return $user->role == '3';
        });

        /* define a Doctor role */
        Gate::define('isDoctor', function ($user) {
            return $user->role == '4';
        });
    }
}
