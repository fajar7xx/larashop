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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('namage-users', function($user){
            // todo: logika untuk mengizikna manage user
            return count(array_intersect(["ADMIN"], json_decode($user->roles)));
        });

        Gate::define('manage-categories', function($user){
            // todo: logika untuk mengizinkan manage categories
            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        });

        Gate::define('manage-books', function($user){
            // todo: logika utnuk mengizinkan manage book
            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        });

        Gate::define('manage-orders', function($user){
            // todo: logika untuk mengizinkan manage order
            return count(array_intersect(["ADMIN", "STAFF"], json_decode($user->roles)));
        });
    }
}
