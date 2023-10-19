<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserService
{
    use HttpResponse;

    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function show(): JsonResponse
    {
        return $this->sucess(new UserResource(Auth::user()));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()
            ]
        ]);

        if ($validator->fails())
            return $this->failure($validator->errors());

        $user = $this->userRepository->createUser($validator->validated());

        return $this->sucess([
            'user' => new UserResource($user),
            'token' => $user->createToken('Personal Token')->plainTextToken,
        ], 201);
    }

    public function update(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails())
            return $this->failure($validator->errors());

        return $this->sucess(new UserResource(
            $this->userRepository->updateUser(Auth::user(), $validator->validated())
        ), 200);
    }
}
