<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('role-admin', function (User $user) {
            return $user->roles()->where('nom', 'admin')->exists();
        });

        Gate::define('role-adherent', function (User $user, User $adherent) {
            return $user->roles()->where('nom', 'adherent')->exists() || $user->id === $adherent->id;
        });
    }
}
