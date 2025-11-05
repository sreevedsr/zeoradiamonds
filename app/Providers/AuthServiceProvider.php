<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        /*
        |--------------------------------------------------------------------------
        | Role-based Gate Definitions
        |--------------------------------------------------------------------------
        | Define all gates and the roles that are allowed to access them.
        | You only need to modify this array to add/remove permissions.
        |--------------------------------------------------------------------------
        */
        $permissions = [
            // Admin-only permissions
            'view-merchants' => ['admin'],
            'edit-cards' => ['admin'],
            'view-rates' => ['admin'],
            'view-suppliers' => ['admin'],
            'create-account' => ['admin'],

            // Merchant-only permissions
            'view-customers' => ['merchant'],
            'view-cards' => ['merchant'],
            'view-market' => ['merchant'],
        ];

        /*
        |--------------------------------------------------------------------------
        | Register all Gates dynamically
        |--------------------------------------------------------------------------
        */
        foreach ($permissions as $ability => $roles) {
            Gate::define($ability, fn($user) => in_array($user->role, $roles));
        }
    }
}
