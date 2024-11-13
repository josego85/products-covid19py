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

    public function jsonResponse($code = 200, $message = null): JsonResponse
    {
        $status = self::HTTP_STATUSES[$code] ?? 'Unknown Status Code';

        return response()->json(
            [
                'status' => $code < 300,
                'message' => $message
            ],
            $code,
            [
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-transform,public,max-age=300,s-maxage=900',
                'Status' => $status
            ],
            JSON_PRETTY_PRINT
        );
    }
}
