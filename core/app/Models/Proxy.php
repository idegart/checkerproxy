<?php

namespace App\Models;

use App\Models\Common\HasUID;
use App\Models\Pivot\ReportProxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Proxy extends Model
{
    use HasFactory;
    use HasUID;

    protected $fillable = [
        'ip_address',
    ];

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Report::class,
            table: ReportProxy::class,
        );
    }
}
