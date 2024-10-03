<?php

namespace App\Traits;

trait BuildResponse
{
    public function buildResponse($statusCode, $message, $data = null)
    {
        $res = [
            'status_code' => $statusCode,
            'message' => $message,
        ];

        if ($data != null) {
            $res = array_merge($res, $data);
        }

        return response()->json($res);
    }
}
