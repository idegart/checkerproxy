<?php

namespace App\Jobs;

use App\Models\Proxy;
use App\Services\Proxy\CheckerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProxy implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly Proxy $proxy,
    )
    {
        $this->onQueue('proxying');
    }

    public function handle(CheckerService $service): void
    {
        $result = $service->check($this->proxy->ip_address);

        $this->proxy->protocol = $result->getProtocol();
        $this->proxy->country = $result->getCountry();
        $this->proxy->speed = $result->getSpeed();
        $this->proxy->completed_at = now();

        $this->proxy->save();

        if ($this->shouldCompleteReport()) {
            $this->proxy->report->completed_at = now();
            $this->proxy->report->save();
        }
    }

    private function shouldCompleteReport(): bool
    {
        if (!is_null($this->proxy->report->completed_at)) {
            return false;
        }

        return $this->proxy->report->proxies()->whereNull('completed_at')->doesntExist();
    }
}
