<?php

namespace App\Http\Routing;

use App\Http\Controllers\API\V1\ReportController;
use Illuminate\Support\Facades\Route;

class V1Routing implements MapRoutingInterface
{
    public function mapRoutes(): void
    {
        Route::name('reports:')
            ->prefix('reports')
            ->group(function () {
                Route::name('index')->get('', [ReportController::class, 'index']);
                Route::name('store')->post('', [ReportController::class, 'store']);
                Route::name('show')->get('{report:uid}', [ReportController::class, 'show']);
            });
    }
}
