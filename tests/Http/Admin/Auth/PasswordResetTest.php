<?php

namespace Tests\Http\Admin\Auth;

use Tests\Http\TestCase;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Auth\ResetPassword as ResetPasswordNotification;
use App\Models\User;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/admin/auth/password/reset';

    protected $method = 'POST';

    /**
     * @test
     * @dataProvider getNotValidData
     *
     * @return void
     */
    public function validate($data)
    {
        $response = $this->send($data);
        $response->assertStatus(422);
    }

    public function getNotValidData()
    {
        return [
            ['required email' => ['token' => 'some token', 'password' => 'pass', 'password_confirmation' => 'pass',]],
            ['email email' => ['email' => 'not email', 'token' => 'some token', 'password' => 'pass', 'password_confirmation' => 'pass',]],
            ['required token' => ['email' => 'some@email.com', 'password' => 'pass', 'password_confirmation' => 'pass',]],
            ['required password' => ['email' => 'some@email.com', 'token' => 'some token']],
            ['confirmed password' => ['email' => 'some@email.com', 'token' => 'some token', 'password' => 'pass', 'password_confirmation' => 'not pass',]],
        ];
    }

    /**
     * @test
     * @dataProvider getPasswordErrors
     *
     * @return void
     */
    public function error($error)
    {
        Password::shouldReceive('reset')->once()->andReturn($error);

        $response = $this->send([
            'email' => 'some@email.com',
            'token' => 'some token',
            'password' => 'new password',
            'password_confirmation' => 'new password',
        ]);

        $response->assertStatus(403);
    }

    public function getPasswordErrors()
    {
        return [
            [Password::INVALID_USER],
            [Password::INVALID_TOKEN],
            [Password::RESET_THROTTLED],
        ];
    }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        Password::shouldReceive('reset')->once()->andReturn(Password::PASSWORD_RESET);

        $response = $this->send([
            'email' => 'some@email.com',
            'token' => 'some token',
            'password' => 'new password',
            'password_confirmation' => 'new password',
        ]);

        $response->assertStatus(200);
    }
}
