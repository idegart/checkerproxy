<?php

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\Response;

class AppResponseFactory
{
    public function makeSuccess(
        array $data = [],
        string $message = 'OK',
        int $httpStatus = Response::HTTP_OK,
    ): AppResponse
    {
        return new AppResponse(
            httpStatus: $httpStatus,
            message: $message,
            data: $data
        );
    }

    public function makeError(
        array $errors = [],
        string $message = 'ERROR',
        int $httpStatus = Response::HTTP_BAD_REQUEST,
    ): AppResponse
    {
        return new AppResponse(
            httpStatus: $httpStatus,
            message: $message,
            errors: $errors
        );
    }
}
