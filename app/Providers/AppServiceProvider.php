<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Company;
use App\Policies\v1\CompanyPolicy;
use Gate;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
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
        Gate::policy(Company::class, CompanyPolicy::class);
    }
}
