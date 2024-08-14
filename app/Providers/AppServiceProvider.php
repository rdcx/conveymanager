<?php

namespace App\Providers;

use App\Contracts\AMLChecker;
use App\Models\ConveyancingCase;
use App\Models\Property;
use App\Policies\ConveyancingCasePolicy;
use App\Policies\PropertyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AMLChecker::class, function () {
            return new \App\Services\AMLCheckService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Property::class, PropertyPolicy::class);
        Gate::policy(ConveyancingCase::class, ConveyancingCasePolicy::class);
    }
}
