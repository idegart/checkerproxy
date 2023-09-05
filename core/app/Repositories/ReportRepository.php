<?php

namespace App\Repositories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Model;

class ReportRepository
{
    public function findByUID(string $uid, array $with = []): Report|Model|null
    {
        return Report::query()->with($with)->firstWhere('uid', $uid);
    }

    public function create(array $proxiesIds): Report
    {
        /** @var Report $report */
        $report = Report::query()->create();

        $report->proxies()->attach($proxiesIds);

        return $report;
    }
}
