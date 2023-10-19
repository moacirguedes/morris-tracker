<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use HttpResponse;

    public function __construct(protected LoginService $loginService)
    {
    }

    public function login(Request $request): JsonResponse
    {
        return $this->loginService->login($request);
    }

    public function logout(Request $request): JsonResponse
    {
        return $this->loginService->logout($request);
    }
}
