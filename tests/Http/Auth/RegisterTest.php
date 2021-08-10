<?php

namespace Tests\Http\Auth;

use App\Models\User;
use Tests\Http\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Str;
use App\Services\AuthService;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/auth/register';

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
            ['required name' => ['email' => 'some@email.com', 'password' => 'secret']],
            ['max name' => ['name' => Str::random(256), 'email' => 'some@email.com', 'password' => 'secret']],
            ['required email' => ['name' => 'some name', 'password' => 'secret']],
            ['email email' => ['name' => 'some name', 'email' => 'not email', 'password' => 'secret']],
            ['required password' => ['name' => 'some name', 'email' => 'some@email.com']],
        ];
    }

    /**
     * @test
     *
     * @return void
     */
    public function validateUniqueEmail()
    {
        $exists = User::factory()->create();
        $response = $this->send(['name' => 'some name', 'email' => $exists->email, 'password' => 'secret']);

        $response->assertStatus(422);
    }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        Event::fake();

        $response = $this->send(['name' => 'some name', 'email' => 'some@email.com', 'password' => 'secret']);

        $response->assertSuccessful();
        $this->assertDatabaseHas('users', ['name' => 'some name', 'email' => 'some@email.com']);

        Event::assertDispatched(\App\Events\Admin\Auth\Registered::class, fn ($event) => $event->user->email == 'some@email.com');
    }
}
