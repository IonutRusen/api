<?php

namespace App\Providers;

use App\Models\Company;
use App\Policies\v1\CompanyPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->singleton(
//            \App\Modules\Facility\Interface\WriteFacilityRepositoryInterface::class,
//            \App\Modules\Facility\Repository\FacilityRepository::class
//        );
//
//        $this->app->singleton(
//            \App\Modules\Facility\Interface\ReadFacilityRepositoryInterface::class,
//            \App\Modules\Facility\Repository\FacilityRepository::class
//        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Gate::policy(Company::class, CompanyPolicy::class);
    }
}
