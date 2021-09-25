<?php

namespace Tests\Http\Admin\Users;

use Tests\Http\TestCase;
use Mockery\MockInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class GetTest extends TestCase
{
    use RefreshDatabase;

    protected $method = 'GET';

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->uri = 'api/admin/users/' . $this->user->id;
    }

    /**
     * @test
     *
     * @return void
     */
    public function authentication()
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
        $response = $this->admin()->send();

        $response->assertSuccessful()
            ->assertJsonFragment(['id' => $this->user->id]);
    }
}
