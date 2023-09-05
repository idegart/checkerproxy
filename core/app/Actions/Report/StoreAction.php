<?php

namespace App\Actions\Report;

use App\Models\Report;
use App\Repositories\ProxyRepository;
use App\Repositories\ReportRepository;

class StoreAction
{
    public function __construct(
        private readonly ReportRepository $reportRepository,
        private readonly ProxyRepository $proxyRepository,
    )
    {
    }

    public function __invoke(
        array $proxies
    ): Report
    {
        $proxiesIds = [];

        foreach ($proxies as $ipAddress) {
            $proxiesIds[] = $this->proxyRepository->createOrFirst($ipAddress)->getKey();
        }

        return $this->reportRepository->create($proxiesIds);
    }
}
