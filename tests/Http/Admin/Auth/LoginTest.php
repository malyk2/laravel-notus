<?php

namespace Tests\Http\Admin\Auth;

use Tests\Http\TestCase;
use Mockery\MockInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\AuthService;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/admin/auth/login';

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
