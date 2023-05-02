<?php

namespace App\Providers;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->registerModulePolicies();

        //
    }

    /**
     * Check Module Policies
     * @author Umar A
     */
    public function registerModulePolicies()
    {
        foreach (config('default-data.modules') as $key => $modules) {
            foreach ($modules as $action => $module) {
                Gate::define($module, function ($user) use ($module, $action) {
                    return $user->hasAccess($module, $action);
                });
            }
        }
    }
}
