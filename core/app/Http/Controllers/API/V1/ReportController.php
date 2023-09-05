<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\Report\ShowAction;
use App\Actions\Report\StoreAction;
use App\Http\Requests\API\V1\Report\ShowRequest;
use App\Http\Requests\API\V1\Report\StoreRequest;
use App\Http\Response\AppResponse;
use App\Http\Response\AwareAppResponseFactory;
use App\Http\Response\HasAppResponseFactoryInterface;
use App\Jobs\ProcessReport;
use App\Models\Proxy;
use Illuminate\Contracts\Bus\Dispatcher;

class ReportController implements HasAppResponseFactoryInterface
{
    use AwareAppResponseFactory;

    public function store(StoreRequest $request, StoreAction $action, Dispatcher $dispatcher): AppResponse
    {
        $report = $action(proxies: $request->getProxies());

        $dispatcher->dispatch(new ProcessReport($report->getUID()));

        return $this->appResponseFactory->makeSuccess([
            'report' => $report->getUID(),
            'proxies' => $report->proxies->map(fn(Proxy $proxy) => [
                'proxy' => $proxy->getUID(),
                'ip_address' => $proxy->ip_address,
            ]),
        ]);
    }

    public function show(ShowRequest $request, ShowAction $action): AppResponse
    {
    }
}
