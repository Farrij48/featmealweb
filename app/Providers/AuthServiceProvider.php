<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
     */
    public function boot(): void
    {
        //--------- PENGECEKAN LEVEL ADMIN UNTUK MENGAKASES MENU DATA USER ----------------//
        $this->registerPolicies();
        Gate::define('manage-users',function($user){
            if($user->level == "admin")
            {
                return TRUE;
            }
        });

        //----------- PENGECEKAN LEVEL ADMIN UNTUK MENGAKASES MENU DATA PASIEN ----------//
        Gate::define('manage-pasien',function($user){
            if($user->level == "admin")
            {
                return TRUE;
            }
        });

        //------- PENGECEKAN LEVEL ADMIN UNTUK MENGAKSES MENU DATA CATEGORY ---------------//
        Gate::define('manage-category',function($user){
            if($user->level == "admin")
            {
                return TRUE;
            }
        });

        //------ PENGECEKAN LEVEL ADMIN UNTUK MENGAKSES MENU DATA RESEP -------------------//
        // Gate::define('manage-resep',function($user){
        //     if($user->level == "admin")
        //     {
        //         return TRUE;
        //     }
        // });

        //----- PENGECEKAN LEVEL CHEF UNTUK MENGAKSES MENU DATA MODULE ---------------------//
        Gate::define('manage-module',function($user){
            if($user->level == "chef")
            {
                return TRUE;
            }
        });        
    }
}