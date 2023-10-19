<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function createUser(array $newUser): User
    {
        return User::create($newUser);
    }

    public function updateUser(User $user, array $newUser): User
    {
        $user->update($newUser);
        return $user->fresh();
    }
}
