<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Http\Resources\Admin\User\ListItem as ListItemResouce;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    const USERS_PAGINATE_PER_PAGE = 15;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = User::where('id', '<>', auth()->id())
            ->latest()
            ->paginate($request->get('per_page', self::USERS_PAGINATE_PER_PAGE));

        return response()->api(ListItemResouce::collection($users));
    }
}
