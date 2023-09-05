<?php

namespace App\Repositories;

use App\Models\Proxy;
use Illuminate\Database\Eloquent\Model;

class ProxyRepository
{
    public function createOrFirst(string $ipAddress): Proxy|Model
    {
        return Proxy::query()->createOrFirst([
            'ip_address' => $ipAddress,
        ]);
    }
}
