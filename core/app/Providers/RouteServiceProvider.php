<?php

namespace App\Providers;

use App\Http\Routing\V1Routing;
use App\Http\Routing\WebRouting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/home';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::name('api:v1:')
                ->prefix('api/v1')
                ->middleware('api')
                ->group(function () {
                    $this->app->make(V1Routing::class)->mapRoutes();
                });
        });
    }
}
