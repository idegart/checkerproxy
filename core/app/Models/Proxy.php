<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $ip_address
 * @property string $protocol
 * @property string $country
 * @property string $speed
 * @property Carbon $completed_at
 * @property-read Report $report
 */
class Proxy extends Model
{
    use HasFactory;

    public function report(): BelongsTo
    {
        return $this->belongsTo(
            related: Report::class,
        );
    }
}
