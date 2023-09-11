<?php

namespace App\Http\Services;


class ResponseService
{
    public static function success(array $data=[], $message = null, int $statusCode = 200)
    {
        return response()->json([
          'success' => true,
            'data' => $data,
          'message' => $message
        ], $statusCode);
    }

    public static function error(array $data=[], $message = null, int $statusCode = 400)
    {
        return response()->json([
          'success' => false,
            'data' => $data,
          'message' => $message
        ], $statusCode);
    }
}