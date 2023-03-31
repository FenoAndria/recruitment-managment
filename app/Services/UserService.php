<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $userData): User
    {
        //TODO: No user should be registered as 'admin', 
        // ...
        return User::create([
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'role_id' => $userData['role_id'],
        ]);
    }

    public function login(array $userData)
    {
        if (Auth::attempt(['email' => $userData['email'], 'password' => $userData['password']])) {
            /** @var \App\Models\User $user  */
            $user = Auth::user();
            $authData['token'] = $user->createToken('LaravelSanctumAuth')->plainTextToken;
            return $authData;
        }
        return false;
    }
}
