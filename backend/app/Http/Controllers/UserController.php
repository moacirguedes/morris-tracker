<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function store(Request $request): JsonResponse
    {
        return $this->userService->store($request);
    }

    public function show(): JsonResponse
    {
        return $this->userService->show();
    }

    public function update(Request $request): JsonResponse
    {
        return $this->userService->update($request);
    }
}
