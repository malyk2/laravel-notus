<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\AuthService;
use App\Models\User;
use App\Http\Resources\Admin\Auth\Me as MeResource;
use App\Http\Requests\Admin\Auth\Register as RegisterRequest;
use App\Http\Requests\Admin\Auth\PasswordReset as PasswordResetRequest;
use App\Http\Requests\Admin\Auth\PasswordForgot as PasswordForgotRequest;
use App\Http\Requests\Admin\Auth\Login as LoginRequest;
use App\Http\Controllers\Controller;
use App\Exceptions\Api\Auth\InvalidSignatureException;
use App\Events\Admin\Auth\Registered as RegisteredEvent;

class AuthController extends Controller
{
    protected $authService;
    protected $userService;

    public function __construct(AuthService $authService, UserService $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
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

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->create($request->validated());

        event(new RegisteredEvent($user));

        return response()->api(true);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
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

    public function verifyEmail(Request $request)
    {
        if (
            !$request->hasValidSignature()
            || !$user = User::find($request->id)
        ) {
            throw new InvalidSignatureException();
        }
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            Auth::login($user);
        }

        return response()->api(new MeResource($user), 'Email verified');
    }

    public function me(Request $request)
    {
        $me = auth()->user();

        return response()->api(new MeResource($me));
    }
}
