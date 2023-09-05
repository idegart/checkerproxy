<?php

namespace App\Providers;

use App\Services\Geo\LocationIPService;
use App\Services\Geo\LocationServiceInterface;
use App\Services\Proxy\CheckerService;
use App\Services\Proxy\Steps\CheckCountryStep;
use App\Services\Proxy\Steps\CheckSpeedStep;
use App\Services\Proxy\Steps\CheckTypeStep;
use App\Services\Speed\SpeedService;
use App\Services\Speed\SpeedServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class CheckerProxyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            abstract: LocationServiceInterface::class,
            concrete: function (Application $application): LocationServiceInterface {
                return new LocationIPService(
                    client: new Client([
                        'base_uri' => 'https://api.country.is/'
                    ]),
                );
            }
        );

        $this->app->bind(
            abstract: SpeedServiceInterface::class,
            concrete: function (): SpeedServiceInterface {
                return new SpeedService(
                    client: new Client([
                        'base_uri' => 'http://speedtest.ftp.otenet.gr',
                    ])
                );
            },
        );

        $this->app->bind(
            abstract: CheckTypeStep::class,
            concrete: function (Application $application): CheckTypeStep {
                return new CheckTypeStep(
                    client: new Client([
                        'base_uri' => 'https://google.com',
                    ]),
                );
            }
        );

        $this->app->bind(
            abstract: CheckerService::class,
            concrete: function (Application $application): CheckerService {
                return new CheckerService(
                    steps: [
                        $application->get(CheckTypeStep::class),
                        $application->get(CheckCountryStep::class),
                        $application->get(CheckSpeedStep::class),
                    ],
                );
            }
        );
    }
}
