<?php

namespace App\Models\Common;

use Illuminate\Support\Str;

trait HasUID
{
    public static function bootHasUID(): void
    {
        self::creating(function (self $model): void {
            $model->setAttribute('uid', strtolower((string) Str::ulid()));
        });
    }

    public function getUID(): string
    {
        return $this->getAttribute('uid');
    }
}
