<?php

namespace App\Traits;

trait HttpResponse
{
    protected function sucess($data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
        ], $status);
    }

    protected function failure($errors = [], $status = 422)
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
        ], $status);
    }
}
