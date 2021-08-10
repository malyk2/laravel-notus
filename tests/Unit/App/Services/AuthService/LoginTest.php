<?php

namespace Tests\Unit\App\Services\AuthService;

use App\Models\User;
use Tests\Unit\TestCase;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\Api\Auth\InvalidCredentailsException;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function email_not_exists()
    {
        /** @var AuthService */
        $service = $this->partialMock(AuthService::class);
        $this->expectException(InvalidCredentailsException::class);
        $service->login(['email' => 'some email']);
    }

    /**
     * @test
     *
     * @return void
     */
    public function wrong_password()
    {
        /** @var AuthService */
        $service = $this->partialMock(AuthService::class);
        $user = User::factory()->create(['email' => 'some@email.com']);
        $this->expectException(InvalidCredentailsException::class);
        Hash::shouldReceive('check')->once()->with('SDF', $user->password)->andReturn(false);

        $service->login(['email' => 'some@email.com', 'password' => 'SDF']);
    }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        /** @var AuthService */
        $service = $this->partialMock(AuthService::class);
        $user = User::factory()->create(['email' => 'some2@email.com']);

        Hash::shouldReceive('check')->once()->with('secret', $user->password)->andReturn(true);
        Auth::shouldReceive('login')->once();
        $result = $service->login(['email' => 'some2@email.com', 'password' => 'secret']);

        $this->assertInstanceOf(User::class, $result);
        $this->assertSame($user->id, $result->id);
    }
}
