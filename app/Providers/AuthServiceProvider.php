<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Room;
use App\Models\Staff;
use App\Models\User;
use App\Policies\RoomPolicy;
use App\Policies\StaffPolicy;
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
         //'App\Models\Role' => 'App\Policies\RolePolicy',

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        foreach (config('premission') as $code=>$label) {
            Gate::define($code, function ($user) use ($code) {
                if (!$user instanceof \App\Models\Staff) {
                    return false;
                }
                return $user->haspremission($code);
            });
            

        }

    }
}



