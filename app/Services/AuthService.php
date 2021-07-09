<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Exceptions\Api\Auth\InvalidCredentailsException;

class AuthService
{
    public function login(array $credentails, bool $rememberMe = false)
    {
        $localUser = User::where('email', strtolower(Arr::get($credentails, 'email')))->first();
        if (
            !$localUser
            || !Hash::check(Arr::get($credentails, 'password'), $localUser->password)
        ) {
            throw new InvalidCredentailsException();
        }
        Auth::login($localUser, $rememberMe);

        return $localUser;
    }
}
