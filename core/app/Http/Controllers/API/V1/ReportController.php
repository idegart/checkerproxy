<?php

namespace App\Http\Controllers\API\V1;

use App\Actions\Report\StoreAction;
use App\Http\Requests\API\V1\Report\StoreRequest;
use App\Http\Resources\Api\V1\ReportResource;
use App\Http\Response\AppResponse;
use App\Http\Response\AwareAppResponseFactory;
use App\Http\Response\HasAppResponseFactoryInterface;
use App\Models\Report;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportController implements HasAppResponseFactoryInterface
{
    use AwareAppResponseFactory;

    public function index(): JsonResource
    {
        return ReportResource::collection(
            Report::query()->cursorPaginate()
        );
    }

    public function store(StoreRequest $request, StoreAction $action): AppResponse
    {
        $report = $action(proxies: $request->getProxies());

        return $this->appResponseFactory->makeSuccess([
            'report' => ReportResource::make($report->load('proxies')),
        ]);
    }

    public function show(Report $report): AppResponse
    {
        return $this->appResponseFactory->makeSuccess([
            'report' => ReportResource::make($report->load('proxies'))
        ]);
    }
}
