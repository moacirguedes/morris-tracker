<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserService
{
    use HttpResponse;

    public function __construct(protected UserRepository $userRepository)
    {
    }


    public function index()
    {
        return $this->sucess(UserResource::collection($this->userRepository->getAllUsers()));
    }

    public function show(int $userId)
    {
        $user = $this->userRepository->getUserById($userId);

        if ($user) {
            return $this->sucess(new UserResource($user));
        }

        return $this->failure('User not found');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()->symbols()
            ]
        ]);

        if ($validator->fails())
            return $this->failure($validator->errors());

        return $this->sucess(new UserResource(
            $this->userRepository->createUser($validator->validated())
        ), 201);
    }

    public function update(Request $request, int $userId)
    {
        $request->merge(['id' => $userId]);

        $validator = Validator::make($request->all(), [
            'id' => 'exists:users,id',
            'name' => 'required'
        ]);

        if ($validator->fails())
            return $this->failure($validator->errors());

        return $this->sucess(new UserResource(
            $this->userRepository->updateUser($userId, $validator->validated())
        ), 200);
    }
}
