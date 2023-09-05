<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $ip_address
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
