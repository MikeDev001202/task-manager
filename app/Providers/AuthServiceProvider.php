<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Tasks;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Tasks::class => TaskPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
        
    }
}
