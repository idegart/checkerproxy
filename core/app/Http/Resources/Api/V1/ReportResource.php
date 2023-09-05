<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Report $resource
 */
class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uid' => $this->resource->getUID(),
            'attributes' => [
                'completed_at' => $this->resource->completed_at,
            ],
            'relations' => [
                'proxies' => ProxyResource::collection($this->whenLoaded('proxies')),
            ],
        ];
    }
}
