<?php

namespace App\Models;

use App\Models\Common\HasUID;
use App\Models\Pivot\ReportProxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Report extends Model
{
    use HasFactory;
    use HasUID;

    public function proxies(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Proxy::class,
            table: ReportProxy::class,
        );
    }
}
