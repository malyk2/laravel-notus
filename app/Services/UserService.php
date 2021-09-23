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

    /**
     * Update user
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data)
    {
        $user->fill(Arr::only($data, ['name', 'email']));
        if($password = Arr::get($data, 'password')) {
            $user->password = bcrypt($password);
        }
        $user->save();

        return $user;
    }
}
