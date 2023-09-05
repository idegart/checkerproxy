<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\Report\ShowAction;
use App\Actions\Report\StoreAction;
use App\Http\Requests\API\V1\Report\ShowRequest;
use App\Http\Requests\API\V1\Report\StoreRequest;
use App\Http\Response\AppResponse;
use App\Http\Response\AwareAppResponseFactory;
use App\Http\Response\HasAppResponseFactoryInterface;

class ReportController implements HasAppResponseFactoryInterface
{
    use AwareAppResponseFactory;

    public function store(StoreRequest $request, StoreAction $action): AppResponse
    {
        $report = $action(proxies: $request->getProxies());

        return $this->appResponseFactory->makeSuccess([
            'report' => $report->getUID(),
        ]);
    }

    public function show(ShowRequest $request, ShowAction $action): AppResponse
    {
    }
}
