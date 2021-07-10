<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\Me as MeResource;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        if ($user = $this->authService->login($request->all())) {
            return response()->success(new MeResource($user));
        }
        return response(true, 400);
    }
}
