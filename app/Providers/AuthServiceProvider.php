<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;
use App\Models\User;
use App\Models\Permission;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //  App\Models\ProductModel::class => App\Policies\ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        ($this->registerPolicies($gate));

        $this->registerPolicies($gate);

        $permissions = Permission::With('roles')->get();

        foreach($permissions as $permission)
        {
            $gate->define($permission->name, function(User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }

        $gate->before(function(User $user){
            if($user->hasAnyRoles('Administrador'))
            {
                return true;
            }
        });
    }
}
