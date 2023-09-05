<?php

namespace App\Models;

use App\Models\Common\HasUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $ip_address
 * @property-read Collection|Proxy[] $proxies
 */
class Report extends Model
{
    use HasFactory;
    use HasUID;

    public function proxies(): HasMany
    {
        return $this->hasMany(
            related: Proxy::class,
        );
    }
}
