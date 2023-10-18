<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getUserById(int $userId): User
    {
        return User::find($userId);
    }

    public function createUser(array $user): User
    {
        return User::create($user);
    }

    public function updateUser(int $userId, array $user): User
    {
        return tap(User::where('id', $userId))->update($user)->first();
    }
}
