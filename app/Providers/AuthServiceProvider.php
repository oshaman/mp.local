<?php

namespace Fresh\Medpravda\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Fresh\Medpravda\Model' => 'Fresh\Medpravda\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('VIEW_ADMIN', function ($user) {
            return $user->canDo();
        });

        Gate::define('USERS_ADMIN', function ($user) {
            return ('admin' === $user->role->name);
        });

        Gate::define('TAGS_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('UPDATE_MEDICINE', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('UPDATE_ARTICLES', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('UPDATE_MEDICINES_CATS', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('MAIN_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('STATIC_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });

        Gate::define('SEO_ADMIN', function ($user) {
            return (('admin' === $user->role->name) || ('editor' === $user->role->name));
        });
    }
}
