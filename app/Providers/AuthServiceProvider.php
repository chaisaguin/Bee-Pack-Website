<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Define your model policy mappings here
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}