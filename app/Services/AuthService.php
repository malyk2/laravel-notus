<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\Api\Auth\InvalidCredentailsException;

class AuthService
{
    /**
     * Login user
     *
     * @param array $credentails
     * @param boolean $rememberMe
     * @throws InvalidCredentailsException
     * @return User
     */
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
