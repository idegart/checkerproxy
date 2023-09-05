<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Proxy;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Proxy $resource
 */
class ProxyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'attributes' => [
                'ip_address' => $this->resource->ip_address,
                'protocol' => $this->resource->protocol,
                'country' => $this->resource->country,
                'speed' => $this->resource->speed,
                'completed_at' => $this->resource->completed_at,
            ],
        ];
    }
}
