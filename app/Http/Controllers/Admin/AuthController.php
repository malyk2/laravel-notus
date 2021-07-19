<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Me as MeResource;
use App\Http\Requests\Auth\Login as LoginRequest;

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
            return response(true, 400);
        }
        return response()->success(new MeResource($user));
    }

    public function me(Request $request)
    {
        $me = auth()->user();

        return response()->success(new MeResource($me));
    }
}
