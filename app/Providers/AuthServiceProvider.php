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

        // Define Gates
        Gate::define('view-merchants', function ($user) {
            return in_array($user->role, ['admin', 'manager']);
        });

        Gate::define('view-cards', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('create-account', function ($user) {
            return $user->role === 'admin';
        });
    }
}
