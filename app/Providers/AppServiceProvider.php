<?php

namespace App\Providers;

use App\Contracts\FlavorServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Services\FlavorService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(FlavorServiceInterface::class, FlavorService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(Carbon::now()->addMinutes(60));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));

        Passport::personalAccessTokensExpireIn(Carbon::now()->addMinutes(120));
    }
}
