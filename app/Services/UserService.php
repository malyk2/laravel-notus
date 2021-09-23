<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\User;

class UserService
{
    /**
     * Create user
     *
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        $user = new User(Arr::only($data, ['name', 'email']));
        $user->password = bcrypt(Arr::get($data, 'password'));
        $user->save();

        return $user;
    }
}
