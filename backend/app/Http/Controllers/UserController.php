<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index()
    {
        return $this->userService->index();
    }

    public function store(Request $request)
    {
        return $this->userService->store($request);
    }

    public function show(int $userId)
    {
        return $this->userService->show($userId);
    }

    public function update(Request $request, int $userId)
    {
        return $this->userService->update($request, $userId);
    }
}
