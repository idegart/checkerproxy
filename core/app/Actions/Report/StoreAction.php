<?php

namespace App\Actions\Report;

use App\Jobs\ProcessProxy;
use App\Models\Proxy;
use App\Models\Report;

class StoreAction
{
    public function __invoke(
        array $proxies
    ): Report
    {
        $report = new Report();
        $report->save();

        foreach ($proxies as $ipAddress) {
            $proxy = new Proxy();
            $proxy->report()->associate($report);
            $proxy->ip_address = $ipAddress;
            $proxy->save();

            dispatch(new ProcessProxy($proxy));
        }

        return $report;
    }
}
