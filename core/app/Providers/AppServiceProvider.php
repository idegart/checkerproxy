<?php

namespace App\Providers;

use App\Http\Response\AppResponseFactory;
use App\Http\Response\HasAppResponseFactoryInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->resolving(
            abstract: HasAppResponseFactoryInterface::class,
            callback: function (HasAppResponseFactoryInterface $controller, Application $application) {
                $controller->setAppResponseFactory($application->get(AppResponseFactory::class));
            }
        );
    }
}
