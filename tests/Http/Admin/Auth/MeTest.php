<?php

namespace Tests\Http\Admin\Auth;

use Tests\Http\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class MeTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'api/admin/auth/me';

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
