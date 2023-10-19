<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginService
{
    use HttpResponse;

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return $this->failure($validator->errors());

        return Auth::attempt($validator->validated()) ? $this->sucess([
            'user' => new UserResource(Auth::user()),
            'token' => Auth::user()->createToken('Personal Token')->plainTextToken,
        ]) : $this->failure(__('auth.failed'));
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->sucess(__('auth.logout'));
    }
}
