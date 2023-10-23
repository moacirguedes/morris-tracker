<?php

namespace App\Traits;

trait HttpResponse
{
    protected function sucess($data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'status' => $status,
            'data' => $data,
        ], $status);
    }

    protected function failure($errors = [], $status = 422)
    {
        return response()->json([
            'success' => false,
            'status' => $status,
            'errors' => $errors,
        ], $status);
    }
}
