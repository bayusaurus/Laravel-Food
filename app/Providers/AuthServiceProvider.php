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

        Gate::define('notDeleted', function ($user) {
            return $user->notDeleted();
        });

        Gate::define('isOwner', function ($user) {
            return $user->inRole('Owner');
        });

        Gate::define('isAdmin', function ($user) {
            return $user->inRole('Admin');
        });

        Gate::define('isKasir', function ($user) {
            return $user->inRole('Kasir');
        });

        Gate::define('isPelayan', function ($user) {
            return $user->inRole('Pelayan');
        });
    }
}
