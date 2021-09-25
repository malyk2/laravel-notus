<?php

namespace Tests\Http\Admin\Users;

use Tests\Http\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use App\Models\User;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    protected $method = 'DELETE';

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
        $service = $this->mock(UserService::class);
        $service->shouldReceive('delete')
            ->once()
            ->andReturn(true);
        $response = $this->admin()->send();

        $response->assertSuccessful();
    }
}
