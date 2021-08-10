<?php

namespace Tests\Http\Auth;

use App\Models\User;
use Tests\Http\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/auth/me';

    protected $method = 'GET';

    /**
     * @test
     *
     * @return void
     */
    public function noAuth()
    {
        $response = $this->send();
        $response->assertStatus(401);
    }

    /**
     * @test
     *
     * @return void
     */
    public function success()
    {
        $response = $this->admin($user = User::factory()->create())->send();

        $response
            ->assertSuccessful()
            ->assertJsonFragment(['id' => $user->id]);
    }
}
