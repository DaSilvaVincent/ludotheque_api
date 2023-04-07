<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Achat;
use App\Models\Commentaire;
use App\Models\User;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('delete-achat', function (User $user, Achat $achat) {
            return $user->roles()->where('nom', 'adherent-premium')->exists() || $user->id === $achat->user_id;
        });
        Gate::define('edit-commentaire', function (User $user, Commentaire $commentaire) {
            return $user->roles()->where('nom', 'commentaire-moderateur')->exists() || $user->id === $commentaire->user_id;
        });
        Gate::define('delete-commentaire', function (User $user, Commentaire $commentaire) {
            return $user->roles()->where('nom', 'commentaire-moderateur')->exists() || $user->id === $commentaire->user_id;
        });
    }
}
