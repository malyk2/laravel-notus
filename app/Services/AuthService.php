<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\User;

class AuthService
{
    public function login(array $credentails, bool $rememberMe = false)
    {
        $localUser = User::where('email', strtolower(Arr::get($credentails, 'email')))->first();
        if (
            !$localUser
            || !Hash::check(Arr::get($credentails, 'email'), $localUser->password)
        ) {
            dd('not found');
        }
        Auth::login($localUser, $rememberMe);

        return $localUser;
    }
}
