<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Employee;
use App\Policies\EmployeePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Licence::class => \App\Policies\LicencePolicy::class,
        \App\Models\Facility::class => \App\Policies\FacilityPolicy::class,
        \App\Models\Employee::class => \App\Policies\EmployeePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('export', [EmployeePolicy::class, 'export']);
    }
}
