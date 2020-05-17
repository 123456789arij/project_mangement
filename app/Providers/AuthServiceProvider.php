<?php

namespace App\Providers;

use App\Employee;
use App\Task;
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
        /* define a admin user role */
/*        Gate::define('employee_actions', function ($employee,$task) {
            return   $task->is(auth()->guard('employee')->user()->role == 1);
//                $task->is(auth()->guard('employee')->user()->role == 1);
        });
        if (Gate::allows('employee_actions')) {
            return  is(auth()->guard('employee')->user()->role == 1);

        }*/

    }
}
