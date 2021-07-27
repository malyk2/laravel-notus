<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\Auth\Me as MeResource;
use App\Http\Requests\Auth\Login as LoginRequest;
use App\Http\Requests\Auth\PasswordReset as PasswordResetRequest;
use App\Http\Requests\Auth\PasswordForgot as PasswordForgotRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (!$user = $this->authService->login(
            Arr::only($data, ['email', 'password']),
            Arr::get($data, 'remember_me', false)
        )) {
            return response([], 400);
        }
        return response()->api(new MeResource($user));
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        return response()->api(true);
    }

    public function passwordForgot(PasswordForgotRequest $request)
    {
        $status = Password::sendResetLink(['email' => $request->email]);

        return $status === Password::RESET_LINK_SENT
            ? response()->api(true, $status)
            : response()->api(false, $status, 403);
    }

    public function passwordReset(PasswordResetRequest $request)
    {
        $status = Password::reset(
            $request->validated(),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->api(true, $status)
            : response()->api(false, $status, 403);
    }

    public function me(Request $request)
    {
        $me = auth()->user();

        return response()->api(new MeResource($me));
    }
}
