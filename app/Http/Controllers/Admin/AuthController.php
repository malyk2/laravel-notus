<?php

namespace App\Http\Controllers\Admin;

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
        if ($user = $this->authService->login($request->validated())) {
            return response()->success(new MeResource($user));
        }
        return response(true, 400);
    }

    public function me(Request $request)
    {
        $me = auth()->user();

        return response()->success(new MeResource($me));
    }
}
