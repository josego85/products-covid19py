<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ResponseService
{
    private const HTTP_STATUSES = [
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
    ];

    public function jsonResponse($code = 200, $message = null)
    {
        return json_encode(array
            (
                'status' => $code < 300,
                'message' => $message
            ),
            JSON_PRETTY_PRINT);
    }
}
