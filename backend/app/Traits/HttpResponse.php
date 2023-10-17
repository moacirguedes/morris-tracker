<?php

namespace App\Traits;

trait HttpResponse
{
    protected function sucess($message, $data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message

        ], $status);
    }

    protected function failure($message, $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message

        ], $status);
    }
}
