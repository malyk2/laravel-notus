<?php

namespace Tests\Http\Admin\Auth;

use Tests\Http\TestCase;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Auth\ResetPassword as ResetPasswordNotification;
use App\Models\User;

class PasswordForgotTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/admin/auth/password/forgot';

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
            ['required email' => []],
            ['email email' => ['email' => 'not email']],
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
        Notification::fake();
        Password::shouldReceive('sendResetLink')->once()->with(['email' => 'some@email.com'])->andReturn($error);

        $response = $this->send([
            'email' => 'some@email.com',
        ]);

        $response->assertStatus(403);
        Notification::assertNothingSent();
    }

    public function getPasswordErrors()
    {
        return [
            [Password::PASSWORD_RESET],
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
        Notification::fake();
        $user = User::factory()->create(['email' => 'some@email.com']);

        $response = $this->send([
            'email' => 'some@email.com',
        ]);

        $response->assertStatus(200);
        Notification::assertSentTo(
            [$user],
            ResetPasswordNotification::class
        );
    }
}
