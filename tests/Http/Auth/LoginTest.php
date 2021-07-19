<?php

namespace Tests\Http\Auth;

use App\Models\User;
use Tests\Http\TestCase;
use Mockery\MockInterface;
use App\Services\AuthService;

class LoginTest extends TestCase
{
    protected $uri = 'api/auth/login';

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
            ['required email' => ['password' => 'some password', 'remember_me' => true]],
            ['required password' => ['email' => 'some@email.com', 'remember_me' => true]],
            ['required remember_me' => ['email' => 'some@email.com', 'password' => 'secret']],
            ['email email' => ['email' => 'not email', 'password' => 'secret', 'remember_me' => true]],
            ['boolean remember_me' => ['email' => 'some@email.com', 'password' => 'secret', 'remember_me' => 'not bool']],
        ];
    }

    /**
     * @test
     *
     * @return void
     */
    public function wrong_credentails()
    {
        $this->mock(AuthService::class, function (MockInterface $mock) {
            $mock->shouldReceive('login')->once()->andReturn(null);
        });

        $response = $this->send([
            'email' => 'some@email.com',
            'password' => 'secret',
            'remember_me' => false,
        ]);

        $response->assertStatus(400);
    }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        $user = User::factory()->create();
        $this->mock(AuthService::class, fn (MockInterface $mock) => $mock->shouldReceive('login')->once()->andReturn($user));

        $response = $this->send([
            'email' => 'some@email.com',
            'password' => 'secret',
            'remember_me' => false,
        ]);

        $response->assertSuccessful()
            ->assertJsonFragment(['id' => $user->id]);
    }
}
