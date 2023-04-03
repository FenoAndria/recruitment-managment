<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Experience;
use App\Models\User;
use App\Policies\ExperiencePolicy;
use App\Policies\JobPolicy;
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
        Job::class => JobPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('user-allowed', function (User $user, $customId) {
            return $user->id == $customId;
        });
    }
}
