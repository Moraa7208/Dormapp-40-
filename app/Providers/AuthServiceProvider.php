<?php

namespace App\Providers;


// use Illuminate\Support\Facades\Gate;
use App\Models\Assignment;
use App\Policies\AssignmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Assignment::class => AssignmentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
