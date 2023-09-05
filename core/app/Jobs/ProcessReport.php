<?php

namespace App\Jobs;

use App\Models\Proxy;
use App\Repositories\ReportRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly string $reportUID,
    )
    {
        $this->onQueue('reporting');
    }

    public function handle(ReportRepository $reportRepository, Dispatcher $dispatcher): void
    {
        $report = $reportRepository->findByUID($this->reportUID, ['proxies']);

        /** @var Proxy $proxy */
        foreach ($report->proxies as $proxy) {
            $dispatcher->dispatch(new ProcessProxy(
                reportUID: $this->reportUID,
                proxyUID: $proxy->getUID(),
            ));
        }
    }
}
