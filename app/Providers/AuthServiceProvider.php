<?php

namespace App\Providers;

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
        "App\Character" => "App\Policies\CharacterPolicy",
        "App\Downtimeperiod" => "App\Policies\DowntimeperiodPolicy",
        "App\Downtime" => "App\Policies\DowntimePolicy",
        "App\Downtimepoint" => "App\Policies\DowntimepointPolicy",
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
