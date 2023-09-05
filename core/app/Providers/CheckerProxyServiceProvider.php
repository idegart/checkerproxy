<?php

namespace App\Providers;

use App\Services\Proxy\CheckerService;
use App\Services\Proxy\Steps\CheckCountryStep;
use App\Services\Proxy\Steps\CheckSpeedStep;
use App\Services\Proxy\Steps\CheckTypeStep;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CheckerProxyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CheckTypeStep::class, function (Application $application): CheckTypeStep {
            return new CheckTypeStep(
                client: new Client([
                    'base_uri' => 'https://google.com',
                ]),
            );
        });

        $this->app->bind(CheckerService::class, function (Application $application): CheckerService {
            return new CheckerService(
                steps: [
                    $application->get(CheckTypeStep::class),
                    $application->get(CheckCountryStep::class),
                    $application->get(CheckSpeedStep::class),
                ],
            );
        });
    }
}
