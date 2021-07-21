<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\Auth\Me as MeResource;
use App\Http\Requests\Auth\Login as LoginRequest;
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

    public function passwordForgot(PasswordForgotRequest $request)
    {
        $status = Password::sendResetLink(['email' => $request->email]);

        return $status === Password::RESET_LINK_SENT
            ? response()->api(true, $status)
            : response()->api(false, $status, 403);
    }

    public function me(Request $request)
    {
        $me = auth()->user();

        return response()->success(new MeResource($me));
    }
}
