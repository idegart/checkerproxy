<?php

namespace App\Http\Response;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class AppResponse implements JsonSerializable
{
    public function __construct(
        private readonly int $httpStatus,
        private readonly string $message = 'OK',
        private readonly array $data = [],
        private readonly array $errors = [],
    )
    {
    }

    #[ArrayShape(['message' => "string", 'data' => "array", 'errors' => "array"])]
    public function jsonSerialize(): array
    {
        $data = [
            'http' => [
                'status' => $this->httpStatus,
            ],
            'message' => $this->message,
        ];

        if ($this->data) {
            $data['data'] = $this->data;
        }

        if ($this->errors) {
            $data['errors'] = $this->errors;
        }

        return $data;
    }
}
