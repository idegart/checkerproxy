<?php

namespace App\Console\Commands;

use App\Jobs\ProcessProxy;
use App\Models\Proxy;
use App\Models\Report;
use Illuminate\Console\Command;

class CheckProxy extends Command
{
    protected $signature = 'app:check-proxy
                            {ips : IP addresses of proxy to check}
    ';

    protected $description = 'Command description';

    public function handle()
    {
        $report = new Report();
        $report->save();

        foreach (explode(',', $this->argument('ips')) as $ipAddress) {
            $proxy = new Proxy();
            $proxy->report()->associate($report);
            $proxy->ip_address = $ipAddress;
            $proxy->save();
        }

        $this->getOutput()->title('Report # ' . $report->getUID());

        $progress = $this->getOutput()->createProgressBar($report->proxies()->count());

        foreach ($report->proxies as $proxy) {
            dispatch_sync(new ProcessProxy($proxy));
            $progress->advance();
        }

        $progress->finish();
        $progress->clear();

        $report->refresh()->load('proxies');

        $this->table([
            'IP',
            'Protocol',
            'Country',
            'Speed',
            'Completed',
        ], [
            ...$report->proxies->map(fn(Proxy $proxy) => [
                $proxy->ip_address,
                $proxy->protocol ?: 'ERROR',
                $proxy->country ?: 'ERROR',
                $proxy->speed ?: 'ERROR',
                $proxy->completed_at ?: 'ERROR',
            ])
        ]);

        $this->getOutput()->success('Completed at: ' . $report->fresh()->completed_at);
    }
}
